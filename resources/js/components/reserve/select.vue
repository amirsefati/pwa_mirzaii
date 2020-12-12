<template>
    <div>

        <div class="row mt-4">
            <div class="col-md-12" style="text-align:center">
                <p style="font-size:22px;font-weight:bold">
                    رزرو خط و شارژ حساب کاربری
                </p>
                <p>
                    برای بسته های ویژه وارد شارژ حساب شوید
                </p>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-md-6 col-6" style="text-align:center;padding:10px 30px 10px 10px">
                <router-link to="/credit">
                    <div style="background:#E3E9FF;border-radius:20px">
                        <img src="./../img/select1.png" width="80%" alt="">
                        <p style="font-size:18px;padding:15px;">شارژ حساب</p>
                    </div>
                </router-link>
            </div>

            <div class="col-md-6 col-6" style="text-align:center;padding:10px 10px 10px 30px">
                <router-link to="/reserve">
                    <div style="background:#E3E9FF;border-radius:20px">
                        <img src="./../img/select2.png" width="80%" alt="">
                        <p style="font-size:18px;padding:15px;">رزرو خط</p>
                    </div>
                </router-link>
            </div>
        </div>
        <br>
    </div>
</template>

<script>
export default {
    
}
</script>