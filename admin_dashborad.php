<?php 
include 'database_conn.php';
// Student count
$student_result = mysqli_query($conn, "SELECT COUNT(*) AS total_students FROM students");
$student_data = mysqli_fetch_assoc($student_result);
$total_students = $student_data['total_students'];

// Faculty count
$faculty_result = mysqli_query($conn, "SELECT COUNT(*) AS total_faculty FROM faculty");
$faculty_data = mysqli_fetch_assoc($faculty_result);
$total_faculty = $faculty_data['total_faculty'];

// Room count
$room_result = mysqli_query($conn, "SELECT COUNT(*) AS total_rooms FROM rooms");
$room_data = mysqli_fetch_assoc($room_result);
$total_rooms = $room_data['total_rooms'];
?>

?>
<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['admin_signin'])) {
    header("Location: admin_signin.php");
    exit();
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_signin.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-400 to-cyan-400 font-sans min-h-screen">

<!-- Responsive Top Navbar for md+ screens -->
<nav class="hidden md:flex justify-between items-center px-6 py-4 bg-gradient-to-r from-indigo-500 via-purple-400 to-cyan-300 text-white shadow-md fixed top-0 left-0 right-0 z-40">
  <div class="text-xl font-bold">Admin Dashboard</div>
 <a href="admin_dashborad.php?logout=true"
     class="bg-gradient-to-r from-indigo-500 via-purple-400 to-cyan-300 text-white hover:bg-red-600 font-medium rounded px-4 py-2 transition mb-5">
    Logout
  </a>
</nav>

  <!-- Mobile Header -->
  <header class="md:hidden bg-white p-4 flex justify-between items-center shadow">
    <h2 class="text-xl font-bold">Admin Dashboard</h2> 
    <button id="toggleSidebar" class="text-2xl font-bold">☰</button>
  </header>

  <div class="flex flex-col md:flex-row h-screen overflow-hidden pt-0 md:pt-16">


    <!-- Sidebar -->
    <aside id="sidebar" class="fixed md:static top-0 left-0 h-full md:h-auto w-64 bg-gradient-to-b from-indigo-900 via-purple-900 to-indigo-800 text-white shadow-md p-6 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 overflow-y-auto">
      <!-- Close button for mobile -->
      <div class="flex justify-between items-center mb-6 md:hidden">
        <h2 class="text-2xl font-bold">Menu</h2>
        <button id="closeSidebar" class="text-xl font-bold">&times;</button>
      </div>
      <a href="admin_dashborad.php?logout=true" id="loginhidden"
     class="hidden bg-gradient-to-r from-indigo-500 via-purple-400 to-cyan-300 text-white hover:bg-red-600 font-medium rounded px-4 py-2 transition mb-5">
    Logout
  </a>
      <h2 class="text-2xl font-bold mb-8 hidden md:block">Admin Dashboard</h2>
       
      <nav class="flex flex-col space-y-6">
        <div>
          <label class="block mb-1 font-semibold">Courses</label>
          <select id="courseselect" class="w-full rounded px-3 py-2 bg-indigo-800 text-white border border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
          <option selected disabled>select</option>
          <option value="All">All student</option>
          <option value="MDCE">MDCE</option>
            <option value="ADCE">ADCE</option>
            <option value="HACKING">HACKING</option>
            <option value="BASIC">BASIC</option>
            <option value="BCA">BCA</option>
            <option value="MCA">MCA</option>
          </select>
        </div>
        <div>
          <label class="block mb-1 font-semibold">Faculty Batch Timing</label>
          <select id="batchTiming" class="w-full rounded px-3 py-2 bg-indigo-800 text-white border border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
          <option selected disabled>select</option>
          <option value="All">All student</option>  
          <option value="MWF-(7:30AM-9:00AM)">MWF-(7:30AM-9:00AM)</option>
        <option value="TTS-(7:30AM-9:00AM)">TTS-(7:30AM-9:00AM)</option>
        <option value="MWF-(9:00AM-10:30AM)">MWF-(9:00AM-10:30AM)</option>
        <option value="TTS-(9:00AM-10:30AM)">TTS-(9:00AM-10:30AM)</option>
        <option value="MWF-(10:30AM-12:00PM)">MWF-(10:30AM-12:00PM)</option>
        <option value="TTS-(10:30AM-12:00PM)">TTS-(10:30AM-12:00PM)</option>
        <option value="MWF-(12:00PM-1:30PM)">MWF-(12:00PM-1:30PM)</option>
        <option value="TTS-(12:00PM-1:30PM)">TTS-(12:00PM-1:30PM)</option>
        <option value="MWF-(2:00PM-3:30PM)">MWF-(2:00PM-3:30PM)</option>
        <option value="TTS-(2:00PM-3:30PM)">TTS-(2:00PM-3:30PM)</option>
        <option value="MWF-(3:30PM-05:00PM)">MWF-(3:30PM-05:00PM)</option>
        <option value="TTS-(3:30PM-05:00PM)">TTS-(3:30PM-05:00PM)</option>
        <option value="MWF-(5:00PM-6:30PM)">MWF-(5:00PM-6:30PM)</option>
        <option value="TTS-(5:00PM-6:30PM)">TTS-(5:00PM-6:30PM)</option>
          </select>
        </div>
  
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-4 md:p-8 overflow-auto">
      <!-- Cards -->
      <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 ">
        <div class="bg-white p-6 rounded shadow transform transition duration-300 hover:scale-105 hover:bg-indigo-100">
          <h3 class="text-lg font-semibold mb-2">Total Students</h3>
          <p class="text-3xl font-bold text-indigo-600"><?= $total_students ?></p>
        </div>
        <div class="bg-white p-6 rounded shadow transform transition duration-300 hover:scale-105 hover:bg-green-100">
          <h3 class="text-lg font-semibold mb-2">Total Faculty</h3>
          <p class="text-3xl font-bold text-green-600"><?= $total_faculty ?></p>
        </div>
        <div class="bg-white p-6 rounded shadow transform transition duration-300 hover:scale-105 hover:bg-yellow-100">
          <h3 class="text-lg font-semibold mb-2">Rooms Available</h3>
          <p class="text-3xl font-bold text-yellow-600"><?= $total_rooms ?></p>
        </div>
      </section>

      

      <!-- Add New Cards -->
     <!-- Add New Cards -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
  <div onclick="openModal('studentModal')" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-indigo-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
    <img src="https://img.icons8.com/ios-filled/100/0000ff/student-registration.png" alt="Add Student" class="mb-4 w-20 h-20 object-contain" />
    <h3 class="text-lg font-semibold mb-2">Add New Student</h3>
    <p class="text-sm text-gray-600 text-center">Click to register a new student.</p>
  </div>
  <div onclick="openModal('facultyModal')" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-green-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
    <img src="https://img.icons8.com/ios-filled/100/008000/teacher.png" alt="Add Faculty" class="mb-4 w-20 h-20 object-contain" />
    <h3 class="text-lg font-semibold mb-2">Add New Faculty</h3>
    <p class="text-sm text-gray-600 text-center">Click to add new faculty member.</p>
  </div>
  <div onclick="openModal('roomModal')" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-yellow-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
    <img src="https://img.icons8.com/ios-filled/100/daa520/meeting-room.png" alt="Add Room" class="mb-4 w-20 h-20 object-contain" />
    <h3 class="text-lg font-semibold mb-2">Add New Room</h3>
    <p class="text-sm text-gray-600 text-center">Click to create a new room entry.</p>
  </div>
  
</section>

<!-- show data of students,faculty -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
  <div onclick="submitStudentInfo()" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-indigo-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
    <img src="https://cdn.pixabay.com/photo/2024/02/19/23/23/web-8584334_960_720.png" alt="Student information" class="mb-4 w-20 h-20 object-contain" />
    <h3 class="text-lg font-semibold mb-2">Student information</h3>
    <p class="text-sm text-gray-600 text-center">Click to see the information of student</p>
  </div>
  <div onclick="window.location.href='view_faculty.php'" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-green-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
    <img src="https://cdn.pixabay.com/photo/2017/12/18/18/43/professor-3026707_1280.jpg" alt="Faculty information" class="mb-4 w-25 h-20 object-contain" />
    <h3 class="text-lg font-semibold mb-2">Faculty information</h3>
    <p class="text-sm text-gray-600 text-center">Click to see the information of faculty.</p>
  </div>
  <div onclick="window.location.href='view_rooms.php'" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-yellow-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
    <img src="https://media.istockphoto.com/id/624652586/photo/computers-in-classroom-on-high-school.jpg?s=1024x1024&w=is&k=20&c=USZ1F-ETGAup_uBAox1EEJTL7G_WPBATmOxzlH0P8GY=" alt="Room information" class="mb-4 w-100 h-20 object-contain" />
    <h3 class="text-lg font-semibold mb-2">Room information</h3>
    <p class="text-sm text-gray-600 text-center">Click to see the information of rooms.</p>
  </div>
  <!-- Assign Batch to Faculty Card -->
<div onclick="window.location.href='assign_batch_tofaculty.php'" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-purple-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
  <img src="https://cdn-icons-png.flaticon.com/512/2965/2965567.png" alt="Assign Batch" class="mb-4 w-20 h-20 object-contain" />
  <h3 class="text-lg font-semibold mb-2 text-purple-700">Assign Batch</h3>
  <p class="text-sm text-gray-600 text-center">Click to assign batch timings to faculties.</p>
</div>
<!-- Faculty Batch Check Card -->
<div onclick="window.location.href='check_faculty_batch.php'" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-blue-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
  <img src="https://cdn-icons-png.flaticon.com/512/3721/3721150.png" alt="Check Faculty Batch" class="mb-4 w-20 h-20 object-contain" />
  <h3 class="text-lg font-semibold mb-2 text-blue-700">Check Faculty Batch</h3>
  <p class="text-sm text-gray-600 text-center">See students taught by a faculty in a selected batch.</p>
</div>
<div onclick="window.location.href='view_faculty_batch.php'" class="bg-white p-6 rounded shadow cursor-pointer hover:bg-red-100 transition transform duration-300 hover:scale-105 flex flex-col items-center">
  <img src="https://cdn-icons-png.flaticon.com/512/10368/10368338.png" class="w-20 h-20 mb-4" />
  <h3 class="text-lg font-semibold mb-2 text-red-600">Deassign Batches</h3>
  <p class="text-sm text-gray-600 text-center">View and remove assigned batches from faculty.</p>
</div>

  
</section>
    </main>
  </div>

  <!-- Modals -->
  <div id="studentModal" class="modal hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class=" bg-white rounded-lg p-6 w-full max-w-md">
      <h3 class="text-xl font-semibold mb-4">New Student Form</h3>
      <form action="studentaddition.php" method="POST">
        <input type="text" name="name" placeholder="Student Name" class="w-full mb-3 p-2 border rounded"required />
  <input type="text" name="age" placeholder="Age" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="roll_no" placeholder="Roll No" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="course" placeholder="Course" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="father_name" placeholder="Father's Name" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="mother_name" placeholder="Mother's Name" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="batch" placeholder="Batch timing" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="mobile" placeholder="Mobile number" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="counsellor" placeholder="Counsellor name" class="w-full mb-3 p-2 border rounded" required />
  <input type="date" name="join_date" placeholder="Joining date" class="w-full mb-3 p-2 border rounded" required />
           
           
        <div class="flex justify-end gap-2">
          <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Submit</button>
          <button type="button" onclick="closeModal('studentModal')" class="text-gray-600">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div id="facultyModal" class="modal hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
      <h3 class="text-xl font-semibold mb-4">New Faculty Form</h3>
      <form action="facultyaddition.php" method="POST">
       <input type="text" name="name" placeholder="Faculty Name" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="age" placeholder="Age" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="experience" placeholder="Experience" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="father" placeholder="Father's Name" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="address" placeholder="Address" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="course" placeholder="Course" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="designation" placeholder="Designation" class="w-full mb-3 p-2 border rounded" required />
  <input type="text" name="salary" placeholder="Salary" class="w-full mb-3 p-2 border rounded" required />
        
        <div class="flex justify-end gap-2">
          <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit</button>
          <button type="button" onclick="closeModal('facultyModal')" class="text-gray-600">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div id="roomModal" class="modal hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
      <h3 class="text-xl font-semibold mb-4">Add New Room</h3>
      <form action="roomaddition.php" method="post">
       <input type="text" name="room_no" placeholder="Room Number" class="w-full mb-3 p-2 border rounded" required  />
      <input type="text" name="capacity" placeholder="Capacity" class="w-full mb-3 p-2 border rounded" required />
        <div class="flex justify-end gap-2">
          <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Submit</button>
          <button type="button" onclick="closeModal('roomModal')" class="text-gray-600">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');
    
    toggleSidebar.addEventListener('click', () => {
      sidebar.classList.remove('-translate-x-full');
       let ab=document.getElementById('loginhidden');
      ab.classList.remove('hidden');
    });

    closeSidebar.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      
    });

    const dataType = document.getElementById('dataType');
    const studentAttendanceBar = document.getElementById('studentAttendanceBar');
    const studentAttendancePercent = document.getElementById('studentAttendancePercent');
    const facultyAttendanceBar = document.getElementById('facultyAttendanceBar');
    const facultyAttendancePercent = document.getElementById('facultyAttendancePercent');
    const overallAttendanceBar = document.getElementById('overallAttendanceBar');
    const overallAttendancePercent = document.getElementById('overallAttendancePercent');

    dataType.addEventListener('change', () => {
      if (dataType.value === 'student') {
        studentAttendanceBar.style.width = '75%';
        studentAttendancePercent.textContent = '75%';
        facultyAttendanceBar.style.width = '0%';
        facultyAttendancePercent.textContent = '0%';
        overallAttendanceBar.style.width = '75%';
        overallAttendancePercent.textContent = '75%';
      } else {
        studentAttendanceBar.style.width = '0%';
        studentAttendancePercent.textContent = '0%';
        facultyAttendanceBar.style.width = '85%';
        facultyAttendancePercent.textContent = '85%';
        overallAttendanceBar.style.width = '85%';
        overallAttendancePercent.textContent = '85%';
      }
    });

    function openModal(id) {
      let open =document.getElementById(id);
      open.classList.remove('hidden');
      open.classList.add('p-5');
    }

    function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
    }
   
  
  </script>
  <form id="studentInfoForm" action="view_student.php" method="POST" style="display: none;">
  <input type="hidden" name="batch" id="selectedBatch">
  <input type="hidden" name="course" id="courses">
</form>
<script>
  function submitStudentInfo() {
  // Get selected batch timing from the sidebar dropdown
  const selectedBatch = document.getElementById('batchTiming').value;
  const course = document.getElementById('courseselect').value;

  // Set the value inside the hidden form input
  document.getElementById('selectedBatch').value = selectedBatch;
  document.getElementById('courses').value = course;

  // Submit the form
  document.getElementById('studentInfoForm').submit();
}
</script>
</body>
</html>
