<template>
  <section>
    <section>
      <div class="container-fluid">
        <div class="card">
          <div v-if="result.success" class="bg-success">
            <div class="d-flex justify-content-center">
              <span>
                <p>{{ result.message }}</p>
              </span>
            </div>
          </div>
          <div v-if="result.error" class="bg-danger">
            <div class="d-flex justify-content-center">
              <span>
                <p>{{ result.error }}</p>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="m-4">
      <div class="col-3 d-flex mr-auto">
        <router-link to="/create">
          <button class="btn btn-info">Add Note</button>
        </router-link>
      </div>
      <!-- section table-->
      <section>
        <div class="mt-5" v-for="note in this.notes" :key="note.id">
          <div class="card">
            <div>
              <div class="card-header">
                <p scope="row">{{ note.id + " " + note.title }}</p>
              </div>
              <div class="card-body">
                <h5>Content</h5>
                <p>{{ note.content }}</p>
                <h5>Created By</h5>
                <p>{{ note.created_by }}</p>
                <h5>Email</h5>
                <p>{{ note.email }}</p>
                <h5>Created at</h5>
                <p>{{ note.created_at }}</p>
                <h5>Updated at</h5>
                <p>{{ note.updated_at }}</p>
              </div>
              <div class="card-footer">
                <button @click="deleteNote(note.id)" class="btn btn-danger">
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
</template>
<script>
export default {
  components: {},
  mounted() {},
  data() {
    return {
      notes: "",
      type: "",
      registration: "",
      note: "",
      result: "",
      errors: "",
    };
  },
  created() {
    this.fetchNotes();
    // window.Event.$on("noteUpdate", () => {
    //   this.fetchNotes();
    // });
  },
  methods: {
    fetchNotes() {
      axios
        .get("/api/notes")
        .then((response) => {
          this.notes = response.data.data;
          console.log(this.notes);
          console.log(this.notes.length);
        })
        .catch(function (e) {
          this.errors = e.response.data.errors;
        });
    },
    showNote(id) {
      this.notes.forEach((t) => {
        if (t.id == id) {
          this.note = t;
        }
      });
      //   console.log( this.note);
      this.openShowModal();
    },
    editNote(id) {
      this.notes.forEach((t) => {
        if (t.id == id) {
          this.note = t;
        }
      });
      this.openEditModal();
    },
    deleteNote(id) {
      axios
        .delete("/api/notes/" + id)
        .then((response) => {
          this.result = response.data;
          console.log(this.orders);
          this.fetchNotes();
        })
        .catch(function (error) {
          console.log(error);
          this.error = error.response.data.data;
        });
    },
  },
};
</script>
