<template>
    <form method="post" :action="endpoint" ref="form">
        <div class="list-group list-group-flush">
            <template v-for="category in categories">
                <div class="list-group-item px-1" :class="itemClasses(category)">
                    <input type="hidden" :name="category.key" value="0">
                    <div class="custom-control custom-checkbox">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            :id="checkboxKey(category)"
                            :disabled="isDisabled(category)"
                            :name="category.key"
                            v-model="currentValue[category.key]"
                            true-value="1"
                            :false-value="isAnonymizable(category) ? '2' : '0'"
                            value="1"
                        >
                        <label class="custom-control-label cc-manage-form__item-label w-100" :for="checkboxKey(category)">
                            <span class="cc-manage-form__item-title">
                                {{ category.title }}
                                <template v-if="category.required">
                                    <span class="cc-manage-form__required-label">{{ requiredLabel }}</span>
                                </template>
                            </span>
                            <span class="cc-manage-form__item-description">{{ category.description }}</span>
                        </label>
                    </div>
                    <template v-if="isAnonymizable(category) && !isActive(category)">
                        <div class="custom-control custom-checkbox mt-3">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="checkboxKey(category, 'anon')"
                                :disabled="isDisabled(category)"
                                :name="category.key"
                                v-model="currentValue[category.key]"
                                true-value="2"
                                false-value="0"
                                value="2"
                            >
                            <label class="custom-control-label cc-manage-form__item-label w-100" :for="checkboxKey(category, 'anon')">
                                <span class="cc-manage-form__item-title">{{ anonymizeLabel }}</span>
                            </label>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            endpoint: {
                type: String,
                required: true,
            },
            categories: Array,
            value: Object,
            requiredLabel: String,
            anonymizeLabel: String,
        },
        data() {
            return {
                currentValue: { ...this.value },
            }
        },
        methods: {
            itemClasses(category) {
                return {
                    'text-muted': this.isDisabled(category),
                }
            },
            checkboxKey(category, key) {
                return `manage-cookies-${category.key}${key ? `-${key}` : ''}`;
            },
            isActive(category) {
                return this.currentValue[category.key] === '1';
            },
            isDisabled(category) {
                return category.required;
            },
            isAnonymizable(category) {
                return category.anonymizable;
            },
            submit() {
                this.$refs.form.submit();
            },
        }
    }
</script>

<style src="../../../scss/components/_manage-form.scss" lang="scss"></style>
