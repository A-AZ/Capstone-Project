<div class="card mb-5">
    <div class="card border-3">
        <div class="card-body ">
            <h2 class="card-title text-center">Informativ Dashboard</h2>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-xl-3 col-sm-6 col-12 mb-5">
        <div class="card shadow border-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Total Items</h5>
                    <h5 class="card-subtitle mb-2 text-muted"><?= $data->items_count  ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-5">
        <div class="card shadow border-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Total Transactions</h5>
                    <h5 class="card-subtitle mb-2 text-muted"><?= $data->transactions_count ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-5">
        <div class="card shadow border-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Total Sales</h5>
                    <h5 class="card-subtitle mb-2 text-muted"><?= $data->sum_total_sales  ?> JOD</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-5">
        <div class="card shadow border-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Total Users</h5>
                    <h5 class="card-subtitle mb-2 text-muted"><?= $data->users_count  ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-5">
        <div class="card shadow border-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Top Expensive Items</h5>
                    <?php foreach ($data->top_expensive as $item) : ?>
                        <h5 class="card-subtitle mb-2 text-muted"><?= $item->item_name ?></h5>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>