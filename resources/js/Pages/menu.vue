<template>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <Link class="navbar-brand" :href="'/'">ApiTest</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <Link   class="nav-link active" aria-current="page"  :href="'/'"  > Home</Link>

                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    }
    
}

</script>