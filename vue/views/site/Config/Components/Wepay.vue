<template>
    <div>
        <el-card shadow="always" :body-style="{ padding: '20px' }">
            <template v-slot:header>微信支付</template>

            <el-form-item label="微信支付商户号">
                <el-input v-model="form.wepay.mch_id" placeholder="请在 微信支付-帐户设置-商户信息 中查看" show-password></el-input>
            </el-form-item>
            <el-form-item label="商户支付API密钥">
                <el-input v-model="form.wepay.key" placeholder="请在 微信支付-安全中心-API安全 中设置或查看" show-password></el-input>
            </el-form-item>
            <el-form-item label="运行模式">
                <el-input v-model="form.wepay.mode" placeholder="沙箱模式需要设置值为dev，香港gateway设置为`hk` "></el-input>
            </el-form-item>
        </el-card>

        <el-card shadow="always" :body-style="{ padding: '20px' }" class="mt-3">
            <template v-slot:header>应用APPID</template>
            <el-form-item label="公众号">
                <el-input v-model="form.wepay.app_id" placeholder="公众号 APPID" show-password></el-input>
            </el-form-item>
            <el-form-item label="小程序">
                <el-input v-model="form.wepay.miniapp_id" placeholder="小程序 miniapp_id" show-password></el-input>
            </el-form-item>
            <el-form-item label="应用程序">
                <el-input v-model="form.wepay.appid" placeholder="应用程序APP APPID" show-password></el-input>
            </el-form-item>
        </el-card>

        <el-card shadow="always" :body-style="{ padding: '20px' }" class="mt-3">
            <template v-slot:header>支付证书</template>
            <el-form-item label="cert_client证书">
                <el-input v-model="form.wepay.cert_client" placeholder="退款等情况时用到" show-password></el-input>
            </el-form-item>
            <el-form-item label="cert_key证书">
                <el-input v-model="form.wepay.cert_key" placeholder="退款等情况时用到" show-password></el-input>
            </el-form-item>
        </el-card>
    </div>
</template>

<script>
export default { route: false, inject: ['form'] }
</script>

<style></style>
