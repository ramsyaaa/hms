<script id="bulkBedActionTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-center item-number">1</td>
        <td>
            <input name="name[]" type="text" class="form-control bedName" required>
        </td>
        <td>
            <select class="form-select bedType fw-bold" name="bed_type[]" placeholder="Select Bed Type" id="bulk-bed-id_{{:uniqueId}}" data-id="{{:uniqueId}}" required>
                <option selected="selected" value >Select Bed Type</option>
                {{for bedTypes}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <input name="charge[]" type="text" class="form-control charge price-input" required>
        </td>
        <td>
            <textarea name="description[]" type="text" class="form-control description" rows="1"></textarea>
        </td>
        <td class="text-center">
         <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>"  class="delete-invoice-item btn px-2 text-danger fs-3">
                        <i class="fa-solid fa-trash"></i>
                    </a>
        </td>
    </tr>





</script>
