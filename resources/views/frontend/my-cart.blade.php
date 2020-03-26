<ul class="">
    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
    <li class="side-menu">
        <?php 
        $items = 0;
        if( !empty($cart) && !empty($cart['items']) ) {
            $items = count($cart['items']);
        }
        
        if($items > 0) { ?>
            <a href="#">
                <i class="fa fa-shopping-bag"></i>
                <span class="badge">{{ $items }}</span>
                <p>My Cart</p>
            </a>
        <?php } else { ?>
            <span class="cart-span">
                <i class="fa fa-shopping-bag"></i>
                <span class="badge">{{ $items }}</span>
                <p>My Cart</p>
            </span>
        <?php } ?>
    </li>
</ul>
