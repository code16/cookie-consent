<template>
    <form method="post" :action="endpoint" ref="form">
        <div class="list-group list-group-flush">
            <template v-for="category in categories">
                <div class="list-group-item px-1" :class="itemClasses(category)">
                    <div class="custom-control custom-checkbox">
                        <input type="hidden" :name="category.key" value="0">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            :id="checkboxKey(category)"
                            :disabled="isDisabled(category)"
                            :name="category.key"
                            :checked="category.value"
                            value="1"
                        >
                        <label class="custom-control-label w-100" :for="checkboxKey(category)">
                            <span class="cc-manage-form__item-title">{{ category.title }}</span>
                            <span class="cc-manage-form__item-description">{{ category.description }}</span>
                        </label>
                    </div>
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
            categories: Object
        },
        methods: {
            itemClasses(category) {
                return {
                    'text-muted': this.isDisabled(category),
                }
            },
            checkboxKey(category) {
                return `manage-cookies-${category.key}`;
            },
            isDisabled(category) {
                return category.required;
            },
            submit() {
                this.$refs.form.submit();
            },
        }
    }
</script>

<style src="../../sass/components/_manage-form.scss" lang="scss"></style>