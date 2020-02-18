<template>
    <b-modal id="manage-cookies" modal-class="cc-manage-modal" v-model="visible" :title="title" @ok="handleOkClicked">
        <template v-slot:modal-title>
            <slot name="title" />
        </template>

        <div class="cc-manage-modal__description mb-3">
            <slot />
        </div>


        <ManageForm
            :endpoint="endpoint"
            :categories="categories"
            ref="form"
        />

        <template v-slot:modal-footer="{ ok, cancel }">
<!--            <button type="button" class="btn btn-secondary" @click="cancel">-->
<!--                <slot name="cancel-button" />-->
<!--            </button>-->
            <button type="submit" class="btn btn-primary" @click="ok">
                <slot name="ok-button" />
            </button>
        </template>
    </b-modal>
</template>

<script>
    import ManageForm from './ManageForm';
    import { BModal } from 'bootstrap-vue';

    export default {
        components: {
            ManageForm,
            BModal,
        },
        props: {
            endpoint: String,
            categories: Object,
            title: String,
        },
        data() {
            return {
                visible: false,
            }
        },
        methods: {
            handleOkClicked() {
                this.$refs.form.submit();
            }
        },
    }
</script>

<!-- not scoped as not working with modal -->
<style src="../../sass/components/_manage-modal.scss" lang="scss"></style>