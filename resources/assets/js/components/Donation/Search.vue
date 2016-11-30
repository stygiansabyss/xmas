<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2">
        <label>Start Date Time</label>
        <input type="text" class="form-control dateSelect" v-model="start" />
      </div>
      <div class="col-md-2">
        <label>End Date Time</label>
        <input type="text" class="form-control dateSelect" v-model="end" />
      </div>
      <div class="col-md-2">
        <label>Comment ></label>
        <input type="number" class="form-control" v-model="length" />
      </div>
      <div class="col-md-2">
        <label>Word/Name</label>
        <input type="text" class="form-control" v-model="word" />
      </div>
      <div class="col-md-2">
        <label>Search Method</label>
        <select class="form-control" v-model="mode">
          <option value="date">Date</option>
          <option value="length">Length</option>
          <option value="word">Word</option>
        </select>
      </div>
      <div class="col-md-2">
        <button
                class="btn btn-primary btn-block btn-sm"
                :class="{ 'btn-primary': runningUpdate == false }"
                @click="search()"
        >
          Search
          <span v-show="donations.length > 0"> (Found {{ donations.length }})</span>
          <i class="fa fa-spinner fa-spin" v-show="runningSearch == true"></i>
        </button>
        <div class="btn-group btn-group-justified" style="margin-top: 5px;">
          <a
                  class="btn btn-block btn-sm"
                  :class="{ 'btn-info': runningUpdate == false }"
                  @click="markDonations('shown')"
                  v-show="donations.length > 0"
                  id="shownButton"
          >
            Mark All Shown
            <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
          </a>
          <a
                  class="btn btn-block btn-sm"
                  :class="{ 'btn-info': runningUpdate == false }"
                  @click="markDonations('read')"
                  v-show="donations.length > 0"
                  id="readButton"
          >
            Mark All Read
            <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
          </a>
          <a
                  class="btn btn-block btn-sm"
                  :class="{ 'btn-info': runningUpdate == false }"
                  @click="markDonations('both')"
                  v-show="donations.length > 0"
                  id="readShownButton"
          >
            Mark All Both
            <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
          </a>
        </div>
      </div>
    </div>
    <br />

    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" role="alert" v-if="errorMessage != null">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{ errorMessage }}
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Comment</th>
              <th>Comment Length</th>
              <th>Amount</th>
              <th>Shown</th>
              <th>Read</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="donation in donations">
              <td>{{ donation.hb_id }}</td>
              <td>{{ donation.name }}</td>
              <td>{{ donation.email }}</td>
              <td class="donation-search-comment">
                {{ donation.comment }}
              </td>
              <td>{{ donation.comment_length }}</td>
              <td>{{ donation.amount }}</td>
              <td>{{ donation.shown_flag }}</td>
              <td>{{ donation.read_flag }}</td>
              <td>{{ donation.created_at_readable }}</td>
              <td>
                <div class="btn-group-vertical btn-block" style="margin-top: 5px;">
                  <a
                          class="btn btn-block btn-sm"
                          :class="{ 'btn-info': runningUpdate == false }"
                          @click="markDonation(donation.id, $index, 'shown')"
                  >
                    Mark Shown
                    <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
                  </a>
                  <a
                          class="btn btn-block btn-sm"
                          :class="{ 'btn-info': runningUpdate == false }"
                          @click="markDonation(donation.id, $index, 'read')"
                  >
                    Mark Read
                    <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
                  </a>
                  <a
                          class="btn btn-block btn-sm"
                          :class="{ 'btn-info': runningUpdate == false }"
                          @click="markDonation(donation.id, $index, 'both')"
                  >
                    Mark Both
                    <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
                  </a>
                  <a
                          class="btn btn-block btn-sm"
                          :class="{ 'btn-danger': runningUpdate == false }"
                          @click="markDonation(donation.id, $index, 'not_read')"
                  >
                    Mark Not Read
                    <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
                  </a>
                  <a
                          class="btn btn-block btn-sm"
                          :class="{ 'btn-danger': runningUpdate == false }"
                          @click="markDonation(donation.id, $index, 'not_shown')"
                  >
                    Mark Not Shown
                    <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
                  </a>
                  <a
                          class="btn btn-block btn-sm"
                          :class="{ 'btn-danger': runningUpdate == false }"
                          @click="markDonation(donation.id, $index, 'neither')"
                  >
                    Mark Neither
                    <i class="fa fa-spinner fa-spin" v-show="runningUpdate == true"></i>
                  </a>
                </div>
              </td>
            </tr>
            <tr v-if="donations.length == 0">
              <td colspan="9">No donations found matching criteria.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<style>
  .donation-search-comment {
    white-space:   pre-line;
    overflow-wrap: break-word;
    word-wrap:     break-word;
    word-break:    break-all;
    width:         25%;
  }
</style>
<script>
  export default {
    data() {
      return {
        mode:          'length',
        start:         app.start,
        end:           app.end,
        length:        app.length,
        word:          null,
        runningUpdate: false,
        runningSearch: false,
        donations:     [],
        errorMessage:  null,
      }
    },

    methods: {
      search() {
        if (this.runningSearch == false) {
          this.runningSearch = true;

          let request = {
            mode:   this.mode,
            start:  this.start,
            end:    this.end,
            length: this.length,
            word:   this.word,
            _token: Laravel.csrfToken
          }
          this.$http.post('/donation/find', request)
              .then((data) =>
              {
                this.$set('donations', data.body);

                this.runningSearch = false;
              }, (error) =>
              {
                this.errorMessage = error.body.error

                this.runningSearch = false;
              });
        }
      },
      markDonations(type) {
        console.log('updating all')
        if (this.runningUpdate == false) {
          this.runningUpdate = true;

          let request = {
            mode:   this.mode,
            start:  this.start,
            end:    this.end,
            length: this.length,
            word:   this.word,
            set:    type,
            _token: Laravel.csrfToken
          }
          this.$http.post('/donation/edit', request)
              .then((data) =>
              {
                this.$set('donations', data.body);

                this.runningUpdate = false;
              }, (error) =>
              {
                this.errorMessage = error.body.error

                this.runningUpdate = false;
              });
        }
      },
      markDonation(id, index, type) {
        console.log('updating single')
        if (this.runningUpdate == false) {
          this.runningUpdate = true;

          let request = {
            set:    type,
            _token: Laravel.csrfToken
          }
          this.$http.post('/donation/edit/'+ id, request)
              .then((data) =>
              {
                this.$set('donations['+ index +']', data.body);

                this.runningUpdate = false;
              }, (error) =>
              {
                this.errorMessage = error.body.error

                this.runningUpdate = false;
              });
        }
      }
    }
  }
</script>
