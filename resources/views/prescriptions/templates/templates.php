<script id="prescriptionMedicineTemplate" type="text/x-jsrender">
    <tr>
        <td class="table__item-desc">
            <select class="form-select prescriptionMedicineId select2Selector" name="medicine[]" placeholder="select medicine" data-id="{{:uniqueId}}" required>
                {{for medicines}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <input class="form-control" required="" name="dosage[]" type="text">
        </td>
        <td>
            <input class="form-control" required="" name="day[]" type="text">
        </td>
        <td>
            <select class="form-select prescriptionMedicineMealId" name="time[]" data-id="{{:uniqueId}}">
                {{for meals}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <textarea class="form-control" required="" name="comment[]" type="text" rows="1"></textarea>
        </td>
        <td class="text-center">
            <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
               class="delete-prescription-medicine-item btn px-1 text-danger fs-3 pe-0">
                     <i class="fa-solid fa-trash"></i>
            </a>
        </td>
    </tr>

</script>
