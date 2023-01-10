<div>
    <div class="d-flex justify-content-center align-items-center">
        <h1>Make a Sale</h1>
    </div>
    <hr>

    <div class="d-flex justify-content-end align-items-center">
        <strong>Total Sales: </strong>
        <span id="total-sales"> </span>
    </div>
</div>


<div class=" my-5">
    <form id="inputForm" class="row my-5">
        <div class="input-group col-lg col-sm-12 mb-3 align-items-center">
            <span class="input-group-text">Item</span>
            <select class="form-select" id="items_name" required>
                <option></option>
                <?php foreach ($data->items as $item) : ?>
                    <?php if ($item->quantity > 0) : ?>
                        <option value="<?= $item->item_name ?>" data-item_id="<?= $item->id ?>" data-price="<?= $item->selling_price ?>"><?= $item->item_name ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group col-lg col-sm-12 mb-3 align-items-center">
            <span class="input-group-text">Item ID</span>
            <input id="item_id" type="number" class="form-control" value="" disabled required>
        </div>

        <div class="input-group col-lg col-sm-12 mb-3 align-items-center">
            <span class="input-group-text">Price (JOD)</span>
            <input id="selling_price" type="number" class="form-control" value="" disabled required>
        </div>

        <div class="input-group col-lg col-sm-12 mb-3 align-items-center">
            <span class="input-group-text">Quantity</span>
            <input id="item_quantity" type="number" class="form-control" min="0" required>
        </div>

        <div class="col-lg col-sm-12 mb-3 d-flex justify-content-center align-items-center">
            <button class="btn btn-success" id="add">Add</button>
        </div>
    </form>
</div>


<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Item</th>
                <th scope="col">Item ID</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody id="transactions_data">
        </tbody>
    </table>
</div>