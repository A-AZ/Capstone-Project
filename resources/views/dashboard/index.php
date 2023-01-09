<h2 class="text-center">informativ dashboard:</h2>
<h3 class="d-flex justify-content-around">items total: <?= $data->items_count  ?></h3>

<h3 class="d-flex justify-content-around">transactions total: <?= $data->transactions_count ?></h3>
<h3 class="d-flex justify-content-around">Users total: <?= $data->users_count ?></h3>
<h3 class="d-flex justify-content-around">total sales: <?= $data->sum_total_sales ?></h3>

<div>

    <?php foreach ($data->top_expensive as $item) : ?>
        <div class="htu-card-wrapper mb-5 col-12">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <?= $item->item_name ?>
                    </h5>
                </div>
            </div>
        </div>
    <?php  endforeach; ?>

</div>