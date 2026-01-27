<?php
namespace App\Services;

use App\Models\Candidate;

class Base {
    protected $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
}

class CandidateManager extends Base {

    public function add(Candidate $c) {
        return mysqli_query(
            $this->conn,
            "INSERT INTO users (name,email,age,gender)
             VALUES ('$c->name','$c->email',$c->age,'$c->gender')"
        );
    }

    public function update($id, Candidate $c) {
        return mysqli_query(
            $this->conn,
            "UPDATE users SET
             name='$c->name',
             email='$c->email',
             age=$c->age,
             gender='$c->gender'
             WHERE id=$id"
        );
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM users WHERE id=$id");
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM users ORDER BY id DESC");
    }
}
