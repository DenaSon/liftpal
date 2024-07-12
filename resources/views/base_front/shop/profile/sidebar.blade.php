<div class="col-lg-3">
    <div class="account-card account-card-menu profile-sidebar">




        <ul class="profile-list">
            <li>
                <i class="fas fa-user-edit profile-icon "></i>
                <a class="" href="{{ route('customerProfile',['action'=>'edit_profile']) }}">  پروفایل</a>
            </li>
            <li>
                <i class="fas fa-cart-plus profile-icon"></i>
                <a href="{{ route('customerProfile',['action'=>'orders']) }}">   سفارش ها </a>
            </li>

            <li>
                <i class="fas fa-cart-plus profile-icon"></i>
                <a href="{{ route('customerProfile',['action'=>'transactions']) }}">    تراکنش ها </a>
            </li>
            
            <li>
                <i class="fas fa-university profile-icon"></i>


                <a href="{{ route('customerProfile',['action'=>'accounts']) }}"> حساب های بانکی   </a>
            </li>

            <li>
                <i class="fas fa-heart profile-icon"></i>


                <a href="{{ route('customerProfile',['action'=>'favorites']) }}">   علاقمندی   </a>
            </li>

            <li>
                <i class="fas fa-mail-bulk profile-icon"></i>

                <a href="{{ route('customerProfile',['action'=>'messages']) }}">  پیغام ها   </a>
            </li>



            <li>
                <i class="fas fa-map-marker-alt profile-icon"></i>




                <a href="{{ route('customerProfile',['action'=>'addresses']) }}"> آدرس ها   </a>
            </li>


            <li>
                <i class="fas fa-sign-out-alt profile-icon"></i>
                <a href=""> خروج از حساب  </a>
            </li>





        </ul>
    </div>
</div>