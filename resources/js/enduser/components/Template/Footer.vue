<template>
<div>
    <footer>
        <div class="container">
            <div class="footer__wrap flex-wrap">
                <p class="flex-grow-1">Copyright © 2021</p>
                <ul class="flex-grow-2">
                    <li ><a  href="/">Home</a></li>
                    <li ><a  href="https://shopee.vn/fuki40">Shop</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>
</template>

<script>
export default {

}
</script>

<style scoped>
.footer__wrap {
    padding: 8px 24px;
    border-top: 1px solid rgba(74, 85, 104);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.footer__wrap>p {
    font-weight: 700;
}

.footer__wrap ul {
    display: flex;
    align-items: center;
}

.footer__wrap ul li {
    padding: 8px;
}
.footer__wrap ul li a {
    font-weight: 700;
    color: #333;
}
 @media only screen and (max-width: 565px) {
    footer .footer__wrap p {
        text-align: center
    }

    footer .footer__wrap p {
        text-align: center
    }

    footer .footer__wrap ul {
        justify-content: center;
        width: 100%;
    }
}
</style>