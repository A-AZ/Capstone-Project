<h3>Edit Item</h3>

<form action="/items/update" method="POST" class="w-50 mt-5">

    <input type="hidden" name="id" value="<?= $data->item->id ?>" reqiuired>
    <div class="input-group mb-3 ">
        <span class="input-group-text" for="item_name">Item Name</span>
        <input type="text" class="form-control" id="item_name" name="item_name" value="<?= $data->item->item_name ?>" reqiuired>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="selling_price">Selling Price</span>
        <input type="number" class="form-control" id="selling_price" name="selling_price" step="any" value="<?= $data->item->selling_price ?>" reqiuired>
        <span class="input-group-text">JOD</span>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="cost_price">Cost Price</span>
        <input type="number" class="form-control" id="cost_price" name="cost_price" step="any" value="<?= $data->item->cost_price ?>" reqiuired>
        <span class="input-group-text">JOD</span>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="quantity">Quantity</span>
        <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $data->item->quantity ?>" reqiuired>
    </div>


    <button type="submit" class="btn btn-warning mt-4">Update</button>
</form>