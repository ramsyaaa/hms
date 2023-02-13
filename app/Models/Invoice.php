<?php

namespace App\Models;

use App\Repositories\InvoiceRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Str;

/**
 * Class Invoice
 *
 * @version February 24, 2020, 5:51 am UTC
 *
 * @property int $id
 * @property int $patient_id
 * @property Carbon $invoice_date
 * @property float $amount
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|InvoiceItem[] $invoiceItems
 * @property-read int|null $invoice_items_count
 * @property-read Patient $patient
 *
 * @method static Builder|Invoice newModelQuery()
 * @method static Builder|Invoice newQuery()
 * @method static Builder|Invoice query()
 * @method static Builder|Invoice whereAmount($value)
 * @method static Builder|Invoice whereCreatedAt($value)
 * @method static Builder|Invoice whereId($value)
 * @method static Builder|Invoice whereInvoiceDate($value)
 * @method static Builder|Invoice wherePatientId($value)
 * @method static Builder|Invoice whereStatus($value)
 * @method static Builder|Invoice whereUpdatedAt($value)
 * @mixin Model
 *
 * @property-read mixed $status_label
 * @property float $discount
 *
 * @method static Builder|Invoice whereDiscount($value)
 *
 * @property string $invoice_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereInvoiceId($value)
 *
 * @property int $is_default
 *
 * @method static Builder|Invoice whereIsDefault($value)
 */
class Invoice extends Model
{
    public const PENDING = 1;

    public const PAID = 0;

    public const STATUS_ALL = 2;

    public const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::PENDING => 'Pending',
        self::PAID => 'Paid',
    ];

    public const FILTER_STATUS_ARR = [
        2 => 'All',
        0 => 'Paid',
        1 => 'Pending',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
        'invoice_date' => 'required|date',
        'discount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
    ];

    public static $messages = [
        'patient_id.required' => 'The patient field is required.',
        'invoice_date.required' => 'The invoice date field is required.',
    ];

    public $table = 'invoices';

    public $appends = ['status_label'];

    public $fillable = [
        'patient_id',
        'invoice_date',
        'invoice_id',
        'amount',
        'discount',
        'status',
        'currency_symbol',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'invoice_id' => 'string',
        'invoice_date' => 'date',
        'amount' => 'double',
        'discount' => 'double',
        'status' => 'boolean',
        'currency_symbol' => 'string',
    ];

    public function getStatusLabelAttribute()
    {
        return self::STATUS_ARR[$this->status];
    }

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function prepareInvoiceItem()
    {
        $data = [];
        foreach ($this->invoiceItems as $invoice_item) {
            $data[] = [
                'id' => $invoice_item->id,
                'account_name' => $invoice_item->account->name,
                'description' => $invoice_item->description ?? 'N/A',
                'quantity' => $invoice_item->quantity,
                'price' => $invoice_item->price,
                'total' => $invoice_item->quantity * $invoice_item->price,
            ];
        }

        return $data;
    }

    /**
     * @return string
     */
    public static function generateUniqueInvoiceId()
    {
        $invoiceId = mb_strtoupper(Str::random(6));
        while (true) {
            $isExist = self::whereInvoiceId($invoiceId)->exists();
            if ($isExist) {
                self::generateUniqueInvoiceId();
            }
            break;
        }

        return $invoiceId;
    }

    public function prepareInvoice(): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'invoice_date' => \Carbon\Carbon::parse($this->invoice_date)->format('d M, Y'),
            'amount' => $this->amount - ($this->discount ? ($this->amount * $this->discount / 100) : 0),
            'status' => $this->status,
            'currency' => getCurrencySymbol(),
        ];
    }

    /**
     * @return array
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function prepareInvoiceDetails(): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'invoice_date' => \Carbon\Carbon::parse($this->invoice_date)->format('d M, Y'),
            'patient_name' => $this->patient->patientUser->full_name,
            'issued_by' => getAppName(),
            'hospital_address' => Setting::where('key', '=', 'hospital_address')->first()->value,
            'address' => $this->patient->address ? $this->patient->address->address1.','.$this->patient->address->address2 : 'N/A',
            'city' => $this->patient->address->city ?? 'N/A',
            'zip' => $this->patient->address->zip ?? 'N/A',
            'currencySymbol' => getCurrencySymbol(),
            'invoice_download' => $this->convertToPdf($this->id),
            'invoice_items' => $this->prepareInvoiceItem(),
            'sub_total' => $this->amount,
            'discount' => $this->discount ? ($this->amount * $this->discount / 100) : 0,
            'total_amount' => $this->amount - ($this->discount ? ($this->amount * $this->discount / 100) : 0),
        ];
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function convertToPdf($id): string
    {
        $invoice = Invoice::with(['invoiceItems', 'patient'])->find($id);
        $data = App()->make(invoiceRepository::class)->getSyncListForCreate($id);
        $data['invoice'] = $invoice;
        $data['currencySymbol'] = getCurrencySymbol();
        if (Storage::exists('invoices/Invoice-'.$invoice->invoice_id.'.pdf')) {
            Storage::delete('invoices/Invoice-'.$invoice->invoice_id.'.pdf');
        }
        $pdf = PDF::loadView('invoices.invoice_pdf', $data);
        Storage::disk(config('app.media_disc'))->put('invoices/Invoice-'.$invoice->invoice_id.'.pdf', $pdf->output());
        $url = Storage::disk(config('app.media_disc'))->url('invoices/Invoice-'.$invoice->invoice_id.'.pdf');

        return $url ?? 'N/A';
    }
}
