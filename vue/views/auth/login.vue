<template>
    <el-form :model="form" ref="form" label-width="80px" :inline="false" size="normal" label-position="top">
        <div class="bg-blue-400 h-screen w-screen">
            <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
                <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
                    <div class="flex flex-col w-full md:w-1/2 p-4">
                        <div class="flex flex-col flex-1 justify-center mb-10">
                            <h1 class="text-4xl text-center font-thin">会员登录</h1>
                            <div class="w-full mt-4">
                                <form class="form-horizontal w-3/4 mx-auto" method="POST" action="#">
                                    <div class="flex flex-col mt-4">
                                        <el-input v-model="form.account" placeholder="邮箱或手机号"></el-input>
                                        <hd-form-error name="account" />
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <el-input v-model="form.password" placeholder="请输入登录密码" type="password"></el-input>
                                        <hd-form-error name="password" />
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <hd-captcha v-model="form.captcha" ref="captcha" />
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <el-checkbox v-model="form.remember">记住我</el-checkbox>
                                    </div>
                                    <div class="flex flex-col mt-8">
                                        <el-button
                                            type="primary"
                                            size="default"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded"
                                            @click="onSubmit"
                                        >
                                            登录
                                        </el-button>
                                    </div>
                                </form>
                                <hd-footer :site="site" />
                            </div>
                        </div>
                    </div>
                    <div
                        class="hidden md:block md:w-1/2 rounded-r-lg"
                        style="background: url('/images/login.jpeg'); background-size: cover; background-position: center center;"
                    ></div>
                </div>
            </div>
        </div>
    </el-form>
</template>

<script>
import HdFooter from './components/Footer'
export default {
    route: { path: '/login', meta: { guest: true } },
    components: {
        HdFooter
    },
    inject: ['site'],
    data() {
        return {
            form: { account: '', password: '', captcha: {}, remember: false }
        }
    },
    methods: {
        async onSubmit() {
            this.$store.commit('errors', {})
            this.axios
                .post(`login`, this.form)
                .then(({ token }) => {
                    const redirectUrl = window.sessionStorage.getItem('redirect_url')
                    location.href = redirectUrl || '/'
                })
                .finally(() => {
                    this.$refs.captcha.get()
                })
        }
    }
}
</script>

<style>
.auth .el-input-group__append {
    padding: 0 !important;
}
</style>
