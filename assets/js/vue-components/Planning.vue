<template>
  <v-row class="fill-height">
    <v-col>
      <v-sheet height="64">
        <v-toolbar
          flat
        >
          <v-btn
            outlined
            @click="setToday"
          >
            Aujourd'hui
          </v-btn>
          <v-btn
            fab
            text
            small
            @click="prev"
          >
            <v-icon small>
              mdi-chevron-left
            </v-icon>
          </v-btn>
          <v-toolbar-title v-if="$refs.calendar">
            {{ $refs.calendar.title.toUpperCase() }}
          </v-toolbar-title>
          <v-btn
            fab
            text
            small
            @click="next"
          >
            <v-icon small>
              mdi-chevron-right
            </v-icon>
          </v-btn>

          <v-spacer></v-spacer>
          <v-menu
            bottom
            right
          >
          </v-menu>
        </v-toolbar>
      </v-sheet>
      <v-sheet height="500">
        <v-calendar
          ref="calendar"
          v-model="focus"
          locale="FR"
          :weekdays="weekday"
          color="primary"
          :events="events"
          :event-color="getEventColor"
          :type="type"
          @click:event="showEvent"
          @change="updateRange"
        ></v-calendar>
      </v-sheet>
    </v-col>
  </v-row>
</template>
  
<script>
export default {
  data: () => ({
    focus: '',
    type: 'week',
    weekday: [1, 2, 3, 4, 5, 6, 0],
    events: [],
    colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
    names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
  }),
  mounted () {
    this.$refs.calendar.checkChange()
  },
  methods: {
    getEventColor (event) {
      return event.color
    },
    setToday () {
      this.focus = ''
    },
    prev () {
      this.$refs.calendar.prev()
    },
    next () {
      this.$refs.calendar.next()
    },
    showEvent ({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event
        this.selectedElement = nativeEvent.target
        requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
      }

      if (this.selectedOpen) {
        this.selectedOpen = false
        requestAnimationFrame(() => requestAnimationFrame(() => open()))
      } else {
        open()
      }

      nativeEvent.stopPropagation()
    },
    updateRange ({ start, end }) {
      const events = []

      const min = new Date(`${start.date}T00:00:00`)
      const max = new Date(`${end.date}T23:59:59`)
      const days = (max.getTime() - min.getTime()) / 86400000
      const eventCount = this.rnd(days, days + 20)

      for (let i = 0; i < eventCount; i++) {
        const allDay = this.rnd(0, 3) === 0
        const firstTimestamp = this.rnd(min.getTime(), max.getTime())
        const first = new Date(firstTimestamp - (firstTimestamp % 900000))
        const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
        const second = new Date(first.getTime() + secondTimestamp)

        events.push({
          name: this.names[this.rnd(0, this.names.length - 1)],
          start: first,
          end: second,
          color: this.colors[this.rnd(0, this.colors.length - 1)],
          timed: !allDay,
        })
      }

      this.events = events

      // const eventCount = Object.values(this.plannings);
      // const events = [];
      // eventCount.forEach((planning) => {
      //   events.push({
      //     planningRefId: planning.id,
      //     name: planning.name,
      //     start: new Date(planning.delivery_date),
      //     color: planning.color
      //   })
      //});
    },
    rnd (a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a
    },
  },
}
</script>