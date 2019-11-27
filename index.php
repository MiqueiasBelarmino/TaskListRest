<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div class="container" style="margin-top: 30px;">
  
        <!-- Botão para acionar modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#todo-modal">
            Nova Tarefa
        </button>
        <hr>
        <h3 align="center" style="margin-bottom: 20px;">Lista de Tarefas</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
       
    </div>

    <div id="todo-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <a class="close" data-dismiss="modal">×</a>
					<h3>Contact Form</h3> -->
				</div>
				<form id="todoForm" name="contact" role="form">
					<div class="modal-body">				
						<div class="form-group">
							<label for="description">Descrição</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Descrição">
						</div>
						<?php
                                $timezone = new DateTimeZone('America/Sao_Paulo');
                                $agora = new DateTime('now', $timezone);
                                $a = $agora->format('d/m/Y');
                        ?>

						<div class="form-group">
							<label for="date_expiration">Data de Vencimento</label>
							<input type="date" name="date_expiration" class="form-control" id="date_expiration">
						</div>
						<div class="form-group">
							<label for="d">Data de Criação</label>
							<input type="hidden" name="date_creation" value="<?php echo $agora->format('Y-m-d');?>" class="form-control" id="date_creation">
							<input type="text" name="d" value="<?php echo $a?>" class="form-control" id="d" disabled>
						</div>

						<div class="form-group">
						<label for="priority">Prioridade</label>
						<select name="priority" placeholder="Prioridade" id="priority">
							<option value="1">Baixa</option>
							<option value="2">Média</option>
							<option value="3">Alta</option>
						</select>
						</div>					
					</div>
                    
					<div class="modal-footer">			
                        <input type="hidden" name="action" id="action" value="addNew" />
                        <input type="submit" id="submitNewTodo" name="submitNewTodo" class="btn btn-primary" value="Add" />
					</div>
				</form>
			</div>
		</div>
    <script>
        $(document).ready(function(){
            $("#todoForm").submit(function(event){
                submitForm();
                return false;
            });

            function submitForm(){
                $.ajax({
                    type: "POST",
                    url: "web/controller.php",
                    cache:false,
                    data: $('form#todoForm').serialize(),
                    success:function(data){
                        $("#todo-modal").modal('hide');
                        outputData();
                    },
                    error: function(){
                        alert("Error");
                    }
                });
            }
            outputData();
            
            function outputData(){
                $.ajax({
                    url: "web/output.php",
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            }

            $('#deleteForm').on('submit', function(event){
                event.preventDefault();
                var formData = $("#deleteForm").serialize();
                $.ajax({
                    url: "web/controller.php",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        outputData();
                        $('#api_form')[0].reset();
                    }
                });
            });
            
            $('#api_form').on('submit', function(event){
                event.preventDefault();
                if($('#description').val() == ''){
                    alert('A descrição é obrigatória!');
                }
                else if($('#date_expiration').val() == ''){
                    alert('A data de vencimento é obrigatória!');
                }
                else{
                    var formData = $(this).serialize();
                    $.ajax({
                        url: "web/controller.php",
                        method: "POST",
                        data: formData,
                        success:function(data){
                            outputData();
                            $('#api_form')[0].reset();
                        }
                    });
                }
            });
            
            
        });
    </script>

    
</body>
</html>