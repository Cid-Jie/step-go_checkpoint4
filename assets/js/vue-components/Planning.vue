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
          @change="updateEvents"
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
    updateEvents({ start, end }) {
      fetch('/api')
          .then(response => response.json())
          .then(response => {
            this.events = response;
          })
    },
  },
}
</script>