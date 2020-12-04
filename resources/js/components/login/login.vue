<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 p-4">
                    <div class="login_box">
                        <div class="row">
                            <div class="col-md-4 col-4" style="text-align:center">
                                <img src="./../img/logo_tehran.png" width="60px" alt="">
                            </div>
                            <div class="col-md-4 col-4" style="text-align:center">
                                
                            </div>
                            <div class="col-md-4 col-4" style="text-align:center">
                                <img src="./../img/fani_t.png" width="80px" alt="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <p>لطفا برای ورود اطلاعات خود را کامل وارد کنید</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="codemeli"> کد ملی :</label>
                                <input type="text" class="form-control" name="codemeli">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="password"> پسورد :</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <button class="btn btn-success pr-5 pl-5" style="border-radius:20px;box-shadow: 5px 4px 20px 1px #999999;" >ورود به سامانه</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import './login.css'
export default {
    date : () =>({

    }),
    created(){

    }
}
</script>