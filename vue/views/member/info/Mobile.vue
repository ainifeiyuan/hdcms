<template>
    <el-form :model="form" ref="form" label-width="80px" :inline="false" size="normal">
        <el-card shadow="never" :body-style="{ padding: '20px' }">
            <div slot="header">
                绑定手机号
            </div>
            <hd-validate-code v-model="form.account" type="mobile" :action="`site/${site.id}/code/mobile/noexist`" placeholder="请输入手机号" />
            <el-input v-model.trim="form.code" placeholder="请输入收到的验证码" size="normal" class="block mt-3"></el-input>
            <hd-form-error name="code" />
            <el-button type="primary" size="default" @click="onSubmit" class="block mt-3" :disabled="!form.account || !form.code">绑定手机</el-button>
        </el-card>
    </el-form>
</template>

<script>
export default {
    route: { meta: { keepAlive: true } },
    inject: ['site'],
    data() {
        return {
            form: { account: '', code: '' }
        }
    },
    methods: {
        async onSubmit() {
            await axios.put(`site/${this.site.id}/user/mobile`, this.form)
        }
    }
}
</script>

<style></style>
