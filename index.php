<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>My Task - App</title>
		<link rel="stylesheet" href="asset/css/material.min.css">
		<link rel="stylesheet" href="asset/css/default.css"/>
		<link rel="stylesheet" href="asset/css/mobile.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script type="text/javascript" src="asset/js/material.min.js"></script>
		<script type="text/javascript" src="asset/js/vue.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
	</head>
	<body>
		<div id="app">
			<div id="container">
				<div id="side-nav">
					<div id="types">
						<span id="app-title">My List</span>
					  <ul>
						  <li>
						  	<span @click="listFilter = 'all'">Overall</span>
						  	<span>{{ taskList.length }}</span>
						  </li>
						  <li>
						  	<span @click="listFilter = 'new'">New</span>
						  	<span>{{ newTaskTotal }}</span>
						  </li>
						  <li>
						  	<span @click="listFilter = 'done'">Done</span>
						  	<span>{{ doneTaskTotal }}</span>
						  </li>
						</ul>
					</div>
				</div>
				<div id="content">
					<div v-if="loader" class="loader"></div>
					<div v-else id="list">
						<h3>To do</h3>
						<div id="items">
							<div v-for="item in sortedList" class="item">
								<div>
									<div class="details">
										<span class="title">{{ item.title }}</span>
										<span class="task-date">Task date: {{ item.task_date }}</span>
									</div>
									<div class="buttons">
										<i @click="openUpdateContainer(item.id)" class="material-icons item-actions">edit</i>
										<i @click="deleteTask(item.id)" class="material-icons item-actions">delete</i>
									</div>
								</div>
								<div v-bind:id="'update-container-' + item.id" class="update-container">
									<p>
										<label for="title">Title</label>
										<input v-model="item.title" type="text" name="title" id="title"/>
									</p>
									<p>
										<label for="description">Description</label>
										<textarea v-model="item.description" name="description" id="description" rows="10" cols="35"></textarea>
									</p>
									<p>
										<label for="task_date">Task date</label>
										<input v-model="item.task_date" type="date" name="task_date">
									</p>
									<p>
										<label for="status">Status</label>
										<select v-model="item.status" name="status">
										  <option value="new">New</option>
										  <option value="done">Done</option>
										</select>
									</p>
									<div>
										<button @click="closeUpdateContainer(item.id)">Close</button>
										<button @click="updateTask(item.id)">Update</button>
										<span v-show="updateTaskMessage != ''">{{ updateTaskMessage }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div v-bind:class="{ 'active': newTaskContainer }" id="add-item-container">
						<span>Save a new task</span>
						<p>
							<label for="title">Title</label>
							<input v-model="newTaskModel.title" type="text" name="title" id="title"/>
						</p>
						<p>
							<label for="description">Description</label>
							<textarea v-model="newTaskModel.description" name="description" id="description" rows="10" cols="35"></textarea>
						</p>
						<p>
							<label for="task_date">Task date</label>
							<input v-model="newTaskModel.task_date" type="date" name="task_date">
						</p>
						<div v-if="newTaskMessage != ''" id="message">{{ newTaskMessage }}</div>
						<div id="actions">
							<button @click="saveNewTask">Save</button>
							<button @click="newTaskContainer = false">Close</button>
						</div>
					</div>

					<button @click="openNewTask"
									id="add-task" 
									class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect">
					  <i class="material-icons">add</i>
					</button>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript" src="asset/js/scripts.js"></script>
