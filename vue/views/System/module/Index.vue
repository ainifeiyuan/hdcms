<template>
    <div>
        <hd-tab :tabs="tabs" />
        <hd-module-list :modules="modules" #default="{ module }" v-loading="loading">
            <el-button-group>
                <el-button type="primary" size="mini" v-if="!module.id" @click="install(module)" :loading="submit">
                    安装模块
                </el-button>
                <el-button type="danger" size="mini" v-if="module.id" @click="uninstall(module)" :loading="submit">
                    卸载模块
                </el-button>
            </el-button-group>
        </hd-module-list>
    </div>
</template>
<script>
import tabs from './tabs'
export default {
    data() {
        return {
            modules: [],
            tabs,
            loading: true,
            submit: false
        }
    },
    async created() {
        this.modules = await this.axios.get(`module`)
        this.loading = false
    },
    methods: {
        async install(module) {
            this.submit = true
            this.$confirm(`确定安装【${module.title}】吗？`)
                .then(_ => this.axios.get(`module/install/${module.name}`))
                .then(async _ => (this.modules = await this.axios.get(`module`)))
                .finally(_ => (this.submit = false))
        },
        async uninstall(module) {
            this.submit = true
            this.$confirm(`确定卸载【${module.title}】吗？`)
                .then(_ => this.axios.delete(`module/uninstall/${module.name}`))
                .then(async _ => (this.modules = await this.axios.get(`module`)))
                .finally(_ => (this.submit = false))
        }
    }
}
</script>

<style></style>
