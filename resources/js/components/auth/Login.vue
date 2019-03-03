<template>
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>OnePlaceCMS</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login</p>
                <form @submit.prevent="authenticate">
                    <div class="input-group mb-3">
                        <input type="email" v-model="form.email" class="form-control" :class="authError ? 'is-invalid' : ''" placeholder="E-Mail Address" name="email" value="" required autofocus>
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                        </div>

                        <div class="invalid-feedback" v-if="authError">
                            {{ authError }}
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" v-model="form.password" class="form-control" :class="authError ? 'is-invalid' : ''" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>

                        <div class="invalid-feedback" v-if="authError">
                            {{ authError }}
                        </div>
                    </div>

                    <div class="row">
                        <!--<div class="col-8">-->
                            <!--<div class="checkbox icheck">-->
                                <!--<label>-->
                                    <!--<input type="checkbox" name="remember">Remember Me-->
                                <!--</label>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!--<p class="mb-1">-->
                    <!--<a href="">Forgot Your Password?</a>-->
                <!--</p>-->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style scoped>
.error {
    text-align: center;
    color: red;
}
</style>

