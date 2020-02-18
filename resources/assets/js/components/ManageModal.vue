<template>
    <b-modal
        id="manage-cookies"
        modal-class="cc-manage-modal"
        v-model="visible"
        :title="title"
        @ok="handleOkClicked"
        @hide="handleHide"
    >
        <template v-slot:modal-title>
            <slot name="title" />
        </template>

        <div class="cc-manage-modal__description mb-3">
            <slot />
        </div>

        <ManageForm
            :endpoint="endpoint"
            :categories="categories"
            :value="value"
            :required-label="requiredLabel"
            :anonymize-label="anonymizeLabel"
            ref="form"
        />

        <template v-slot:modal-footer="{ ok }">
            <button type="submit" class="btn btn-primary" @click="ok">
                <slot name="ok-button" />
            </button>
        </template>
    </b-modal>
</template>

<script>
    import ManageForm from './ManageForm';
    import { BModal } from 'bootstrap-vue';

    function resetLocationtHash() {
        if(history && history.replaceState) {
            history.replaceState(null, null, `${window.location.pathname}${window.location.search}`);
        } else {
            location.hash = '';
        }
    }

    export default {
        components: {
            ManageForm,
            BModal,
        },
        props: {
            endpoint: String,
            value: Object,
            categories: Array,
            title: String,
            requiredLabel: String,
            anonymizeLabel: String,
        },
        data() {
            return {
                visible: false,
            }
        },
        methods: {
            handleOkClicked() {
                this.$refs.form.submit();
            },
            handleHide() {
                if(location.hash === '#manage-cookies') {
                    resetLocationtHash();
                }
            },
            init() {
                if(location.hash === '#manage-cookies') {
                    this.visible = true;
                }
            },
        },
        created() {
            this.init();
            window.addEventListener('hashchange', this.init);
        },
        destroyed() {
            document.removeEventListener('hashchange', this.init);
        },
    }
</script>

<!-- not scoped as not working with modal -->
<style src="../../sass/components/_manage-modal.scss" lang="scss"></style>