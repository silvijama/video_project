<template>
    <div class="card-body">
       
      <form @submit.prevent="saveData">
          
            <div v-if="errors.length" class="row">
                <div v-for="error in errors" :key="error" class="alert alert-danger col-md-4 col-md-offset-4" align="center">
                    <small>{{ error }}</small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputSubject">Subject name</label>
                <input v-model="form.name" type="text" class="form-control" id="inputSubject" autocomplete="off">
            </div>

            <div class="form-group col-md-4">
            <label for="semester">Semester</label>
            <select v-model="form.semester" id="semester" class="form-control">
                <option disabled selected value> Select a semester </option>
                <option value="ljetni">Ljetni</option>
                <option value="zimski">Zimski</option>
            </select>
            </div>
            
            <div class="form-group col-md-2">
                <label for="ects">ECTS</label>
                <input v-model="form.ects"  type="number" min="1" max="10" class="form-control" id="ects" autocomplete="off">
            </div>
        </div>
        
        <button v-if="this.isEdit == false" class="btn btn-outline-success" type="submit" id="button-addon2">Add subject</button>
        <button v-else type="button" v-on:click="updateSubject()" class="btn btn-outline-primary" id="button-addon2">Update subject</button>
      </form>

        <hr>
        <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">ECTS</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                
                <tr v-for="subject in data" :key="subject.id">
                    <td>{{ subject.id }}</td>
                    <td>{{ subject.name }}</td>
                    <td>{{ subject.ects }}</td>
                    <td>{{ subject.semester }}</td>
                    <td><button @click="editSubject(subject.id, subject.name, subject.ects, subject.semester)" class="btn btn-outline-info">Edit</button></td>
                    <td><button @click="deleteSubject(subject.id)" class="btn btn-outline-danger" >Delete</button></td>
                </tr>
                
                </tbody>
            </table>
            
    </div>
</template>

<script>
    export default {
        name: 'Subject',
        data () {
            return  {
             data: [],
             isEdit: false,
             errors: [],
             form: new Form({
                 id: '',
                 name: '',
                 ects: '',
                 semester: '',
             }),   
            }
        },

        methods: {
            getSubjects () {
                axios.get('api_subjects/get_subjects')
                .then(res => {
                    this.data = res.data
                }).catch(e => console.log(e))
            },
            editSubject (id, name, ects, semester) {
                this.id            = id
                this.form.name     = name
                this.form.ects     = ects
                this.form.semester = semester
                this.isEdit = true
            },
            

            updateSubject () {
                if (this.form.name && this.form.ects && this.form.semester) {
                    axios.put(`api_subjects/${this.id}`, { 
                    name: this.form.name,
                    ects: this.form.ects,
                    semester: this.form.semester
                    })
                    .then(res => {
                        this.errors = '',
                        this.form.name = '',
                        this.form.ects = '',
                        this.form.semester = '', 
                        this.isEdit = false,

                        this.getSubjects()
                        
                    }).catch(err => {
                        console.log(err)
                    })
                } else {
                    this.errors = [];

                    if (!this.form.name) {
                        this.errors.push('Name required.');
                    }
                    
                }
             
            },

            saveData () {
                let data = new FormData();
                if (this.form.name && this.form.ects && this.form.semester) {
                    data.append('name', this.form.name)
                    data.append('ects', this.form.ects)
                    data.append('semester', this.form.semester)

                    axios.post('api_subjects', data)
                    .then(res => {
                        this.errors = ''
                        this.form.reset()
                        this.getSubjects()
                        console.log(res)
                    })
                    .catch((error) => {
                        console.log(error)
                    })
                } else {
                    this.errors = [];

                    if (!this.form.name) {
                        this.errors.push('Name required.');
                    }
                    if (!this.form.ects) {
                        this.errors.push('ECTS required.');
                    }
                    if (!this.form.semester) {
                        this.errors.push('Semester required.');
                    }
                }
            },

            deleteSubject (id) {
                axios.delete(`api_subjects/${id}`)
                .then(res => {
                    this.getSubjects();
                }).catch(err => {
                    console.log(err)
                })
            },
        },

        created () {
            this.getSubjects()
        }

    
    }
</script>
