<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip,Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

const props = defineProps({
    companies: Object
})

const chartData = {
    labels: props.companies[0].lighthouse_reports.map(({ created_at }) => new Date(created_at).toDateString()),
    datasets: props.companies.map(( item ) => {
        let company = {
            label: item.name,
            data: item.lighthouse_reports.map(({ accessibility }) => accessibility)
        }
        return company
    }),
    tension: 0.1,

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
    {{ companies.map(( item ) => {
        let company = {
            label: item.name,
            data: item.lighthouse_reports.map(({ accessibility }) => accessibility)
        }
        return company
    }) }}
    <Line :data="chartData" :options="options" />
</template>
