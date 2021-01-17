<template>
    <div class="card">
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item">
                    <a class="page-link" v-if="data.prev_page_url" :href="data.prev_page_url">«</a>
                </li>
                <li class="page-item" v-for="item in data.links">
                    <a v-if="item != data.links[0] && item != data.links[data.links.length -1]" :href="item.url" class="page-link" :class="{active: item.active}">{{item.label}}</a>
                </li>
                <li class="page-item">
                    <a class="page-link" v-if="data.next_page_url" :href="data.next_page_url">»</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: [
        'data',
    ],
}
</script>


