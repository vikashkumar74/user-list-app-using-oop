<?php
require_once "classes/Database.php";
require_once "classes/CandidateManager.php";

use App\Database\Database;
use App\Services\CandidateManager;

$conn = Database::getConnection();
$manager = new CandidateManager($conn);
$result = $manager->getAll();

echo "<table>
<tr>
<th>Name</th><th>Email</th><th>Age</th><th>Gender</th><th>Action</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['age']}</td>
        <td>{$row['gender']}</td>
        <td class='actions'>
            <button class='edit' onclick=\"editUser({$row['id']},'{$row['name']}','{$row['email']}',{$row['age']},'{$row['gender']}')\">Edit</button>
            <button onclick=\"deleteUser({$row['id']})\">Delete</button>
        </td>
    </tr>";
}
echo "</table>";

