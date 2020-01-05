@extends('layouts.master')
@section('content')
   
<div style="margin-top: 60px;" class="fluid-container" id="app">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">message</th>
            <th scope="col">email</th>
            <th scope="col">phone</th>
            <th scope="col">name</th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="msg in messages">
                <td class="col-2">@{{msg.message}}</td>
                <td class="col-2">@{{msg.email}}</td>
                <td class="col-2">@{{msg.phone}}</td>
                <td class="col-6">@{{msg.name}}</td>

            </tr>
        </tbody>
       
      </table>
</div>

@endsection
@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            messages: [],
        },
        methods: {
            getMessages() {
                axios.get('/api/messages').then(response =>{
                    this.messages = response.data;
                    console.log(this.messages);
                    
                })
                
            }
        },
        mounted() {
            this.getMessages();
        }
    
    })
    </script>
@endsection
