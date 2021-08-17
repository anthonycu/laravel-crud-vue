<template>
    <div>
        <hr>
        <h1 class="text-center">Estudiantes de la Universidad #</h1>
        <hr>
        <!-- Button trigger modal -->
        <button @click="update=0;openModal();" type="button" class="btn btn-primary">
        + Nuevo Estudiante
        </button>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Tipo de Identificación</th>
                    <th scope="col">Número de identificación</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Carrera</th>
                    <th scope="col" colspan="2" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stu in students" :key="stu.id">
                    <th scope="row">{{stu.id}}</th>
                    <td>{{stu.names}}</td>
                    <td>{{stu.surname}}</td>
                    <td>{{stu.idType}}</td>
                    <td>{{stu.idNumber}}</td>
                    <td>{{stu.gender}}</td>
                    <td>{{stu.dateOfBirth}}</td>
                    <td>{{stu.career}}</td>
                    <td>
                        <button @click="update=1;openModal(stu);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="deleteStudent(stu.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- Modal -->
<div class="modal" :class="{show:modal}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
        <button @click="closeModal();" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
        </button>
      </div>
      <div class="modal-body">
          <div>
              <label for="names"></label>
            <input v-model="student.names" type="text" class="form-control" name="names" id="names" placeholder="Nombres">
          </div>
          <div>
              <label for="surname"></label>
            <input v-model="student.surname" type="text" class="form-control" name="surname" id="surname" placeholder="Apellidos">
          </div>
          <div>
              <label for="idType"></label>
            <input v-model="student.idType" type="number" class="form-control" name="idType" id="idType" placeholder="Tipo de Identificación">
          </div>
          <div>
              <label for="idNumber"></label>
            <input v-model="student.idNumber" type="number" class="form-control" name="idNumber" id="idNumber" placeholder="Número de identificación">
          </div>
          <div>
              <label for="gender"></label>
            <input v-model="student.gender" type="number" class="form-control" name="gender" id="gender" placeholder="Sexo">
          </div>
          <div>
              <label for="dateOfBirth"></label>
            <input v-model="student.dateOfBirth" type="date" class="form-control" name="dateOfBirth" id="dateOfBirth" placeholder="Fecha de nacimiento">
          </div>
          <div>
              <label for="career"></label>
            <input v-model="student.career" type="text" class="form-control" name="career" id="career" placeholder="Carrera">
          </div>
      </div>
      <div class="modal-footer">
        <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button @click="save();" type="button" class="btn btn-success">Guardar</button>
      </div> 
    </div>
  </div>
</div>
        
    </div>
</template>

<script>
export default ({
    data() {
        return {
            student:{
                names:'',
                surname:'',
                idType:'',
                idNumber:'',
                gender:'',
                dateOfBirth:'',
                career:'',
            },
            id: 0,
            update: true,
            modal: 0,
            titleModal:'',
            students: [],
        }
    },
    methods: {
        async getStudents(){
            const res = await axios.get('/students');
            this.students = res.data;
        },
        async deleteStudent(id){
            const res = await axios.delete('/students/'+id);
            this.getStudents();
        },
        async save(){
            if(this.update){
                const res = await axios.put('/students/'+this.id,this.student);
            } else {
                const res = await axios.post('/students',this.student);
            }
            this.closeModal();
            this.getStudents();
        },
        openModal(data={}){
            this.modal = 1;

            if(this.update){
                this.id = data.id;
                this.titleModal = 'Actualizar Estudiante';
                this.student.names = data.names;
                this.student.surname = data.surname;
                this.student.idType = data.idType;
                this.student.idNumber = data.idNumber;
                this.student.gender = data.gender;
                this.student.dateOfBirth = data.dateOfBirth;
                this.student.career = data.career;
            } else { 
                this.id = 0;
                this.titleModal = 'Nuevo Estudiante';
                this.student.names = '';
                this.student.surname = '';
                this.student.idType = '';
                this.student.idNumber = '';
                this.student.gender = '';
                this.student.dateOfBirth = '';
                this.student.career = '';
            }
        },
        closeModal(){
            this.modal = 0;
            
        },
    },
    created() {
        this.getStudents();
    },
})
</script>

<style>
    .show{
        display: list-item;
        opacity: 1;
        background: rgb(red, green, blue);
    }
</style>