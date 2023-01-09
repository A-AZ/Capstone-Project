<h3>Edit Transaction</h3>

<form action="/transactions/update" method="POST" class="w-50 mt-5">

    <input id="user_id" type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>" required>
    <input type="hidden" name="id" value="<?= $data->transaction->id ?>" required>
    
    <div class="input-group input-group mb-3 ">
        <span class="input-group-text">Item</span>
        <input type="text" class="form-control" id="items_name" name="items_name" value="<?= $data->transaction->item_name ?>" required>
    </div>
    <div class="input-group mb-3 ">
        <span class="input-group-text" for="selling_price">Selling Price</span>
        <input type="number" class="form-control" id="selling_price" name="selling_price" value="<?= $data->transaction->selling_price ?>" required>
        <span class="input-group-text">JOD</span>
    </div>


    <div class="input-group mb-3 ">
        <span class="input-group-text" for="quantity">Quantity</span>
        <input type="number" class="form-control" id="quantity" name="quantity" value="" required>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="quantity">Total Sales</span>
        <input type="number" class="form-control" id="total_sales" name="total_sales" value="" required>
    </div>

    <button type="submit" class="btn btn-warning mt-4">Update</button>
</form>




<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $('#selling_price, #quantity').on('input', function() {
        $('#total_sales').val($('#selling_price').val() * $('#quantity').val());
    });
</script>