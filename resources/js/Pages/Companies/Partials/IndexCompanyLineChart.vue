<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip,Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

const props = defineProps({
    data: Object
})

let datasets = array_combine(
    Object.values(Object.values(props.data)).map(item => Object.values(item).map(item => item.performance)),
    Object.keys(props.data)
)

const chartData = {
    labels: Object.keys(Object.values(props.data)[0]).map(date => new Date(date).toDateString()),
    datasets: [{
        label: 'test',
        data: Object.values(Object.values(props.data)[2]).map(item => item.performance)
    }],
}

const options = {
    scales: {
      y: {
            min: 0,
            max: 100
        }
    }
}
</script>

<template>
    {{ datasets }}
    <Line :data="chartData" :options="options" />
</template>
