<template>
    <form @submit.prevent="login">
        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                <h5 class="content-group">Đăng nhập <small class="display-block">Điền thông tin tài khoản</small></h5>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input type="text" class="form-control" v-model="infoLogin.user_name" placeholder="Username">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input type="password" class="form-control" v-model="infoLogin.password" placeholder="Password">
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login<i class="icon-circle-right2 position-right"></i></button>
            </div>

            <div class="text-center">
                <a href="javascript:void(0)" @click="forgotPassword">Quên mật khẩu?</a>
            </div>
        </div>
    </form>
</template>
<script>
    import axios from 'axios'
    import cookie from 'vue-cookie'
    import vue from 'vue'
    vue.use(cookie)
    export default {

        methods:{
            forgotPassword()
            {
                this.$emit('forget_password')
            },
            login(){
                var vm = this
                    axios.post('/api/login',vm.infoLogin).then(data => {
                        this.$cookie.set('token',data.data.token,{
                            expires: 1
                        })
                        console.log(data)
                    }).catch(err => {
                        console.log(err)
                    })
            }
        },
        data(){
            return {
                infoLogin: {
                    user_name:'',
                    password: ''
                }
            }
        }
    }
</script>