<?php
    function CreateProduct($ProductName, $OldPrice, $NewPrice, $ProductImg, $Description, $ProductId)
    {
        $ProductCard = "
        <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$ProductImg\" class=\"img-fluid card-img-top product\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$ProductName</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                $Description
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">$OldPrice</s></small>
                                <span class=\"price\">$$NewPrice</span>
                            </h5>
                            <button type=\"submit\" class=\"btn btn-success my-3\" name=\"Add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type=\"hidden\" name=\"pid\" value=\"$ProductId\"/>
                        </div>
                    </div>
                </form>
            </div>
        ";

        echo($ProductCard);
    }   // CreateProduct

    function CreateCartProduct($ProductId, $ProductImg, $ProductName, $ProductPrice)
    {
        $CartProduct = "
            <form action=\"cart.php?action=remove&id=$ProductId\" method=\"post\" class=\"pad\">
                <div class=\"border rounded\">
                    <div class=\"row bg-white\">
                        <div class=\"col-md-3 pl-0\">
                            <img src=$ProductImg class=\"img-fluid product\">
                        </div>
                        <div class=\"col-md-6\">
                            <h5 class=\"pt-2\">$ProductName</h5>
                            <small class=\"text-secondary\">Seller: dailytuition</small>
                            <h5 class=\"pt-2\">$$ProductPrice</h5>
                            <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                        </div>
                        <div class=\"col-md-3 py-5\">
                            <div>
                                <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        ";
        echo($CartProduct);
    }   // CreateCartProduct