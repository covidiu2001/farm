<div class="product-categorie-box" id="product_display">
    <div class="tab-content">
        <span id="new_item_count" class="d-none"><?php echo count($products) ?></span>
        <div role="tabpanel" class="tab-pane fade <?php echo ($listView == '#list-view') ? 'show active' : ''; ?>" id="list-view">
            <?php foreach($products as $product) {
                $stoc_product = $stoc['product_id_' . $product->id]['0'];
                $available_quantity = $stoc_product->intrari - $stoc_product->iesiri;
            ?>
                @include('frontend.product_list')
            <?php } ?>

            <?php if( $products instanceof \Illuminate\Pagination\AbstractPaginator ) {
                echo $products->links();
            } ?>
        </div>
        <div role="tabpanel" class="tab-pane fade <?php echo ($listView == '#grid-view') ? 'show active' : ''; ?>" id="grid-view">
            <div class="row">
                <?php foreach($products as $product) {
                    $stoc_product = $stoc['product_id_' . $product->id]['0'];
                    $available_quantity = $stoc_product->intrari - $stoc_product->iesiri;
                ?>
                    @include('frontend.product_grid')
                <?php } ?>               
            </div>

            <?php if( $products instanceof \Illuminate\Pagination\AbstractPaginator ) {
                echo $products->links();
            } ?>
        </div>
    </div>
</div>