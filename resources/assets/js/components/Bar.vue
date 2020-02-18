<template>
    <transition appear>
        <div class="cc-cookie-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md">
                        <slot name="message" />
                    </div>
                    <div class="col-md-auto mt-2 mt-md-0">
                        <div class="row mx-n2 justify-content-end">
                            <template v-if="manage">
                                <div class="col-auto px-2">
                                    <button class="btn btn-link cc-cookie-bar__link px-0" v-b-modal.manage-cookies><slot name="manage-link" /></button>
                                </div>
                            </template>
                            <div class="col-auto px-2">
                                <form method="post" :action="endpoint">
                                    <button type="submit" class="btn btn-primary cc-cookie-bar__btn"><slot name="accept-button" /></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import ManageForm from "./ManageForm";
    import { VBModal } from 'bootstrap-vue';

    export default {
        components: {
            ManageForm,
        },
        props: {
            endpoint: String,
            manage: Boolean,
        },
        directives: {
            'b-modal': VBModal,
        }
    }
</script>

<style src="../../sass/components/_bar.scss" lang="scss"></style>