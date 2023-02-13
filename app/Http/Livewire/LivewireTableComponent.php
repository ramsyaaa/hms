<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

/**
 * Class LivewireTableComponent
 */
class LivewireTableComponent extends DataTableComponent
{
    protected bool $columnSelectStatus = false;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = false;

    public bool $paginationStatus = true;

    public bool $sortingPillsStatus = false;

    protected $listeners = ['refresh' => '$refresh'];

    public string $emptyMessage = 'No data available in table';

    // for table header button
    public $showButtonOnHeader = false;

    public $buttonComponent = '';

    public function configure(): void
    {
        // TODO: Implement configure() method.
    }

    public function columns(): array
    {
        // TODO: Implement columns() method.
    }

    public function mountWithPagination(): void
    {
        if ($this->getPerPage()) {
            $this->getPerPageAccepted()[] = -1;
        }

        $this->setPerPage($this->getPerPageAccepted()[0] ?? 10);
    }
}
