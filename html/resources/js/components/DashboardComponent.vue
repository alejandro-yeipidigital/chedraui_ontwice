<template>
  <div class="row">
        <div class="col-12 col-lg-6 col-xl-3" v-for="(element, id) in data" :key="id">
            <div class="widget widget-tile">
            <div class="chart sparkline" id="spark1"><canvas width="85" height="35" style="display: inline-block; width: 85px; height: 35px; vertical-align: top;"></canvas></div>
            <div class="data-info">
                <div class="desc">{{ element.classification }}</div>
                <div class="value">
                    <span class="indicator indicator-equal mdi mdi-chevron-right"></span>
                    <span class="number">{{ element.total }}</span>
                </div>
            </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    props: ['data'],
    mounted () {
        console.log('Esto llega')
        console.log(this.data)
    }
}
</script>

<style>

</style>