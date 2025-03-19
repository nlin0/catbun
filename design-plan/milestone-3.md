# Project 3, Milestone 3: **Team** Design Journey

[← Table of Contents](design-journey.md)

**Make the case for your decisions using concepts from class, as well as other design principles, theories, examples, and cases from outside of class (includes the design prerequisite for this course).**

You can use bullet points and lists, or full paragraphs, or a combo, whichever is appropriate. The writing should be solid draft quality.


## Milestone 2 Team Feedback Revisions
> Explain what your **team** collectively revised in response to the Milestone 2 feedback (1-2 sentences)
> If you didn't make any revisions, explain why.

We did not have any major collective revisions as according to the Milestone 2 feedback.


## File Upload - Types of Files
> What types of files will you allow users to upload?
> Can users upload any type of file? Can user only upload one type of file?
> Or can users upload several different types of files?
> List the file extensions of the types of files your users may upload.

- PNG
- JPEG


## File Upload - Updated DB Schema
> Plan any updates you need to make to your database schema to support file uploads.
>
> 1. Copy your Project 3 DB Schema for the _entries_ table here.
> 2. Modify the schema to include any file upload information you desire to store in your database.
>    If you don't need to modify anything, explain why.

Art

```
- id: INT {PK, U, NN, AI}
- title: TEXT {NN}
- descr: TEXT {none}
- year: INT {NN}
- file_path: TEXT {NN}
```

We did not need to modify anything as we included file_path, which keeps track of the associated image's name and file extension.

## File Upload - File Storage
> Plan the file path to store the uploaded files on the server's file system.
> Store the uploaded files in a subfolder of the `public/uploads` folder using the entries table name as the subfolder name.

public/uploads/images


## File Upload - Path and URL
> Assume that a user completed the insert/edit entry form.
> The **id** for the new record is **154**.
>
> 1. Plan the file system path to store the uploaded file.
> 2. Plan the URL to load the uploaded file in your website's HTML.

**File System Storage Path:**

```
/uploads/images/154
```

**Resource URL:**

```
<picture>
  <img src="uploads/images/154.jpg">
</picture>
```


## File Upload - Form Input
> Write the HTML of an `<input>` element that allows users to upload a file.

```html
<input type="file" name="drawing" accept="image/png,image/jpeg">
<input type="hidden" name="max_size" value="<?php echo max_size; ?>">
```


## File Upload - PHP File Upload Data
> Use the `name` attribute of the file input you planned above to plan how you will
> access the uploaded file data in PHP using the `$_FILES` superglobal.
> Write the PHP code to access the uploaded file data from the `$_FILES` superglobal.
> Only include the data you will extract from the `$_FILES` superglobal. For example, the file name.
> Hint: <https://www.php.net/manual/en/features.file-upload.post-method.php>

```
$_FILES["drawing"][name]
```


## Filtering by a Tag - Query String Parameters
> Plan the query string for filtering by a tag for the "view all" pages.
> (This plan should be exactly the same for both the consumer and admin views.)
> Include the query string parameter and its value.
> Document the value with the field from your database in all CAPITOL letters.

Example: `?category=ID` where `ID` is the `id` field from the `categories` table.

?tag=tags.name

## Filtering by a Tag - SQL Query Plan
> Plan the SQL query to retrieve all entries with a specific tag using the query string parameter.

```
INNER JOIN
art_tags ON art.id = art_tags.art_id
INNER JOIN tags ON art_tags.tags_id = tags.id
WHERE tags.name = :tag
```

## Contributors

I affirm that I have contributed to the team requirements for this milestone.

Consumer Lead: Nicole Lin

Admin Lead: Shihan Gao


[← Table of Contents](design-journey.md)
