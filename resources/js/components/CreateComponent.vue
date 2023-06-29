<template>
  <!--messages-->
  <section>
    <div class="container-fluid sticky-top">
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
  <!--create card section-->
  <section>
 <router-link to="/notes">
          <button class="btn btn-success m-3">View Notes</button></router-link
        >
    <div class="mt-5">
      <div class="card">
        <div class="card-header">
          <h3>Fill in the fields to register a new note</h3>
        </div>
        <div class="card-body">
          <div class="well m-2">
            <label for="type">Enter title of note</label>
            <small v-if="errors.title">
              <span
                class="text-danger"
                v-for="(error, index) in errors.title"
                :key="index"
              >
                {{ error }}
              </span>
            </small>
            <input
              class="form-control mt-1"
              type="text"
              name="title"
              id="title"
              required
              v-model="title"
            />
          </div>
          <!-- email -->
          <div class="well m-2">
            <label for="type">Enter your email</label>
            <small v-if="errors.email">
              <span
                class="text-danger"
                v-for="(error, index) in errors.email"
                :key="index"
              >
                {{ error }}
              </span>
            </small>
            <input
              class="form-control mt-1"
              type="text"
              name="email"
              id="email"
              v-model="email"
              required
            />
          </div>

          <!-- Name -->
          <div class="well m-2">
            <label for="type">Enter your Name</label>
            <small v-if="errors.created_by">
              <span
                class="text-danger"
                v-for="(error, index) in errors.created_by"
                :key="index"
              >
                {{ error }}
              </span>
            </small>
            <input
              class="form-control mt-1"
              type="text"
              name="created_by"
              id="created_by"
              v-model="created_by"
              required
            />
          </div>

          <!-- content -->
          <div class="well m-2">
            <label for="type">Enter your content</label>
            <small v-if="errors.content">
              <span
                class="text-danger"
                v-for="(error, index) in errors.content"
                :key="index"
              >
                {{ error }}
              </span>
            </small>
            <textarea
              class="form-control mt-1"
              type="text"
              name="content"
              id="content"
              v-model="content"
              required
            ></textarea>
          </div>
        </div>
        <div class="card-footer">
          <router-link to="/notes" class="mx-3">
            <button class="btn btn-danger mr-3">Cancel</button></router-link
          >
          <button class="btn btn-success ml-3 mx-3" @click="createNote">
            Save Note
          </button>
        </div>
      </div>
    </div>
  </section>
  <!-- end card section-->
</template>
<script>
export default {
  components: {},
  mounted() {},
  data() {
    return {
      notes: "",
      note: "",
      result: "",
      errors: "",
      title: "",
      content: "",
      created_by: "",
      email: "",
    };
  },
  created() {},
  methods: {
    createNote() {
      axios
        .post("./api/notes", {
          title: this.title,
          content: this.content,
          created_by: this.created_by,
          email: this.email,
        })
        .then((response) => {
          this.result = response.data;
          this.emptyFields();
        })
        .catch((e) => {
          console.log(e.response.data);
          this.errors = e.response.data.errors;
        });
    },

    emptyFields() {
      this.title = "";
      this.content = "";
      this.created_by = "";
      this.email = "";
    },
  },
};
</script>

