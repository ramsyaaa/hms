<script id="ipdPrescriptionItemTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-center prescription-item-number">1</td>
        <td>
            <select class="form-select ipdCategoryId select2Selector" name="category_id[]" placeholder="Select Category" data-id="{{:uniqueId}}" required>
                <option selected="selected" value >Select Category</option>
                {{for medicineCategories}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <select class="form-select medicineId select2Selector" name="medicine_id[]" data-medicine-id="{{:uniqueId}}" disabled></select>
        </td>
        <td>
            <input class="form-control dosage" name="dosage[]" type="text" onkeypress = 'return avoidSpace(event);' required>
        </td>
        <td>
            <textarea class="form-control instruction" name="instruction[]" rows="1" onkeypress = 'return avoidSpace(event);' required></textarea>
        </td>
        <td class="text-center">
            <i class="fa fa-trash text-danger deleteIpdPrescription cursor-pointer" data-edit="0"></i>
        </td>
    </tr>


</script>

<script id="editIpdPrescriptionItemTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-center edit-prescription-item-number" data-item-number="{{:uniqueId}}">1</td>
        <td>
            <select class="form-select ipdCategoryId select2Selector" name="category_id[]" placeholder="Select Category" data-id="{{:uniqueId}}" required>
                <option selected="selected" value>Select Category</option>
                {{for medicineCategories}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <select class="form-select medicineId select2Selector" name="medicine_id[]" data-medicine-id="{{:uniqueId}}" disabled></select>
        </td>
        <td>
            <input class="form-control" name="dosage[]" type="text" data-dosage-id="{{:uniqueId}}" onkeypress = 'return avoidSpace(event);' required>
        </td>
        <td>
            <textarea class="form-control" name="instruction[]" rows="1" data-instruction-id="{{:uniqueId}}" onkeypress = 'return avoidSpace(event);' required></textarea>
        </td>
        <td class="text-center">
            <i class="fa fa-trash text-danger deleteIpdPrescriptionOnEdit cursor-pointer" data-edit="1"></i>
        </td>
    </tr>

</script>
