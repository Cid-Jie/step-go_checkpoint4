<template>
  <v-row class="fill-height">
    <v-col>
      <v-sheet height="64" width="1250">
        <v-toolbar
          flat
        >
          <v-btn
            outlined
            class="mr-4"
            color="darken-1"
            @click="setToday"
          >
            Aujourd'hui
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            fab
            text
            small
            color="grey darken-2"
            @click="prev"
          >
            <v-icon small>
              &lt;
            </v-icon>
          </v-btn>
          
          <v-toolbar-title v-if="$refs.calendar">
            {{ $refs.calendar.title.toUpperCase() }}
          </v-toolbar-title>
         
          <v-btn
            fab
            text
            small
            color="grey darken-2"
            @click="next"
          >
            <v-icon small>
               &gt;
            </v-icon>
          </v-btn>
          <v-spacer></v-spacer>
        </v-toolbar>
      </v-sheet>
        <v-sheet height="500" width="1250">
          <v-calendar
            ref="calendar"
            v-model="focus"
            locale="FR"
            :weekdays="weekday"
            :events="events"
            :event-color="getEventColor"
            :type="type"
            interval-count=14
            first-interval=11
            @change="updateEvents"
          >

          <template v-slot:event="{ event }">
              <p class="text-center">
                {{ event.danceClasse }}<br/>
                {{ event.start.substr(11) }} - {{ event.end.substr(11) }} <span class="text-italic">{{ event.description }}</span><br/>
              </p>
          </template>
        
          </v-calendar>
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
    // Call api to retrieve all informations of the database
    updateEvents({ start, end }) {
      const firstDay = start.date
      const lastDay = end.date
      // Add start date and end date of the week
      fetch(`/get-events?start=${firstDay}&end=${lastDay}`)
          .then(response => response.json())
          .then(response => {
            this.events = response;      
          })
    },
  },
}
</script>