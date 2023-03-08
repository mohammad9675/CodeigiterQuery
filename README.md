# CodeIgniter CRUD and more Queries 
This code contains a PHP class Utility that provides several utility functions for performing common tasks such as adding data to the database, retrieving data from the database, and uploading files.

## Requirements:
CodeIgniter PHP framework <br>
AuthLib utility that you can find [here](http://example.com/ "Title").
## Installation:
Copy the Utility.php file to the application/models directory in your CodeIgniter project.
Create an instance of the Utility class in your controller or wherever you want to use it. Example: $this->load->model('Utility');

## Functions:
```php
public function add($view, $info, $table, $redirectPage, $data = null, $data2 = array(), $data3 = array(), $data4 = array(), $path = 'uploads/', $path2'uploads/', $name = 'files', $name2 = 'files2')
```

This function is used to add data to the database. It takes several parameters:

$view - the view file to load <br> 
$info - an array of data to add to the database      <br>
$table - the name of the table to add the data to <br>
$redirectPage - the page to redirect to after the data has been added <br>
$data - additional data to pass to the view <br>
$data2 - additional data to pass to the view <br>
$data3 - additional data to pass to the view <br>
$data4 - additional data to pass to the view <br>
$path - the path to upload the first file <br>
$path2 - the path to upload the second file <br>
$name - the name of the first file input field <br>
$name2 - the name of the second file input field <br>

```php
public function addVideo($view, $info, $table, $redirectPage, $data = null, $data2 = array(), $data3 = array(), $data4 = array(), $path = 'uploads/', $path2 = 'uploads/', $name = 'files', $name2 = 'files', $name3= 'files1')
```      
<br> <br>                                       
This function is similar to add but is specifically designed for adding videos. It takes additional parameters: 

$name3 - the name of the third file input field <br>

```php
public function getAll($table)
```
<br> <br>
This function retrieves all data from a table. <br>

```php
public function getWithId($table,$id,$field='id')
```
<br><br>
This function retrieves data from a table based on a specific ID. <br><br>

```php
public function singleGet($table,$id,$field,$nuid)
```
<br><br>
This function retrieves a single value from a row in the database.  <br><br>

```php
public function getAllJoin($view, $table, $joiner, $field, $field2, $option = null, $option2 = null, $option3 = null, $option4 = null,$data2=null,$condition=null,$condition_field=null)
```

<br><br>
The purpose of this function is to retrieve data from a MySQL database by performing a join between two tables. The specific data to be retrieved is determined by the $field and $field2 parameters. The $joiner parameter specifies the second table for the join. <br><br>

```php
public function getById($view, $table, $field, $id, $table2 = null, $field2 = null, $id2 = null,$data3=null,$departments=null,$data4=null,$data5=null,$data6=null,$data7=null)
```
<br><br>

This function retrieves data from a MySQL database based on the specified $id value and renders a view or template with the retrieved data.If $table2 is not null, the function performs a join with the second table and stores the results. <br><br>

```php
public function edit($view, $table, $filed, $id, $info, $redirectPage, $table2 = null, $path = 'uploads/', $path2 = 'uploads/', $name = 'files', $name2 = 'files2', $data3 = null)
```
<br><br>
This function allows for editing of a row in database based on the specified $id value.  <br><br>


```php
public function delete($redirectPage, $table, $field, $id)
```
<br><br>

This function  allows for the deletion of a row from database based on the specified $id value. <br><br>


```php
public function hash($msg)
```
<br><br>
This function can use for hashing base on a givven key  <br><br>

```php
public function unhash($msg)
```
<br><br>
This function unhash the hashed string by hash function  <br><br>

```php
public function uploadFile($path = 'uploads/', $name = 'files')
```
<br><br>
This function allows uploading an image, this can be used with the insert function. <br><br>

```php
public function update($status,$fiield,$table,$redirect)
```
<br><br>
This function update the status field of a row in the database <br><br>

```php
public function getJOin($table, $joiner, $field, $field2, $option = null, $option2 = null, $option3 = null, $option4 = null,$data2=null)
```
<br><br>
This function join two tables based on the givven condition. <br><br>

```php
public function getWithDate($table,$id,$start,$end,$field1,$field2,$field_id)
```
<br><br>
This function retrieve the data in a specific date range. <br><br>




