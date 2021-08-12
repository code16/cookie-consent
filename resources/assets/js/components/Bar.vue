<template>
    <div>
        <transition appear>
            <template v-if="backdrop">
                <div class="modal-backdrop cc-cookie-bar__backdrop"></div>
            </template>
        </transition>
        <transition appear>
            <div class="cc-cookie-bar" :class="classes">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md">
                            <slot name="message" />
                        </div>
                        <div class="col-md-auto mt-2 mt-md-0">
                            <div class="row align-items-center justify-content-end">
                                <template v-if="manage">
                                    <div class="col-auto">
                                        <button class="btn btn-link btn-sm cc-cookie-bar__link px-0" v-b-modal.manage-cookies><slot name="manage-link" /></button>
                                    </div>
                                </template>
                                <div class="col-auto">
                                    <form method="post" :action="endpoint">
                                        <button type="submit" class="btn btn-primary btn-lg cc-cookie-bar__btn"><slot name="accept-button" /></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
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
            backdrop: Boolean,
        },
        computed: {
            classes() {
                return {
                    'cc-cookie-bar--modal container': this.backdrop,
                }
            }
        },
        directives: {
            'b-modal': VBModal,
        }
    }
</script>

<style src="../../scss/components/_bar.scss" lang="scss"></style>
