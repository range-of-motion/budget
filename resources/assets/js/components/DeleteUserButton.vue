<template>
    <div>
        <button
            class="button link button--link-danger"
            @click.prevent="showWarning">Delete</button>
        <div
            v-if="warningShown"
            style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.50); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);"
            @click.self="hideWarning">
            <div style="margin: 50px auto; max-width: 500px; padding: 20px; background: #FFF; border-radius: 5px;">
                <div>Are you sure you want to delete your user? This is irreversible.</div>
                <div class="row mt-2">
                    <form method="POST" action="/settings/account/delete">
                        <input
                            type="hidden"
                            name="_token"
                            :value="csrfToken" />
                        <button class="button button--danger mr-2">Yes, I am sure</button>
                    </form>
                    <button
                        class="button button--light"
                        @click="hideWarning">No</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'csrfToken'
    ],

    data() {
        return {
            warningShown: false
        };
    },

    methods: {
        showWarning() {
            this.warningShown = true;
        },

        hideWarning() {
            this.warningShown = false;
        },

        doIt() {
            // axios.
        }
    }
};
</script>
