<template>
  <div>
      <nav class="navbar">
            <div class="container">
                <div class="navbar__wrap">
                    <a href="" class="navbar__logo">logo</a>
                    <ul>
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                        <li><a href="" class="goToShop">Go to shop </a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar--mobile">
            <div class="container">
                <div class="navbar--mobile__wrap">
                    <a href="">logo</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbar--mobile" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbar--mobile">
                        <li><a class="dropdown-item" href="#"><i class="fab fa-facebook-f me-2"></i> Facebook</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fab fa-youtube me-2"></i> Youtube</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fab fa-instagram me-2"></i> Instagram</a></li>
                        <li><a class="dropdown-item" href="#"><span class="me-2"></span>  Go to shop</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </nav>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.navbar {
    margin-bottom: 40px
}
.navbar__wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.navbar ul {
    display: flex
}

.navbar ul li {
    padding: 16px
}

.navbar ul li i {
    font-size: 20px
}

.navbar ul li .goToShop {
    padding: 8px 16px;
    border-radius: 4px;
    background-color: #333;
    color: #fff;
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
    font-weight: 700;
}

.navbar--mobile__wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 80px;
    position: relative;
}
.navbar--mobile {
    display: none;
    margin-bottom: 40px
}

.navbar--mobile .dropdown-menu{
    transform: unset!important;
    inset: unset!important;
    top: 80px!important;
    left: 0!important;
    width: 100%;
    padding: 16px;
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 10%), 0 4px 6px -2px rgb(0 0 0 / 5%);
}

.navbar--mobile .dropdown-menu li {
    padding: 8px 0px
}

.navbar--mobile .dropdown-menu li a {
    font-weight: 700
}
.navbar--mobile .dropdown-menu li a i{
    color: #ccc
}
.navbar--mobile .nav-item.dropdown{
    width: 40px;
    height: 40px;
    border: 2px solid #333;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: static;
}

.navbar--mobile .nav-item i {
    font-size: 30px;
    color: #333;
}

.dropdown-item i {
    width: 40px;
    display: inline-block;
}


@media only screen and (max-width: 565px) {
    .navbar {
        display: none
    }

    .navbar--mobile {
        display: block
    }
}
</style>