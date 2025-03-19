# Project 3, Milestone 3: **Administrator** Design Journey

[← Table of Contents](../design-journey.md)


## Milestone 2 Feedback Revisions
> Explain what you individually revised in response to the Milestone 1 feedback (1-2 sentences)
> If you didn't make any revisions, explain why.

I had to revise the table so that each entire row was clickable instead of having an actions column with the edit button.


## Edit Form - UPDATE query
> Plan your query to update an entry in your catalog.

```sql
"UPDATE art SET title = :title, descr = :descr, yr = :yr, file_path = :file_path WHERE id = :art_id",
            array(
                ":title" => $title,
                ":descr" => $descr,
                ":yr" => $yr,
                ":file_path" => $file_path,
                ":art_id" => $art_id
            )
```

## Edit Form - Sample Test Data
> Document sample test data to edit an entry in your catalog.
> Upload a sample file to the `design-plan/admin` folder for us to upload when editing the entry.

**Sample Edit Data:**

- Title: Girl and Bunny
- Description: Example
- Year: 2024

**Sample Upload File:** `design-plan/admin/girl-and-bunny.png`


## Contributors

I affirm that I am submitting my work for the administrator requirements in this milestone.

Admin Lead: Shihan Gao


[← Table of Contents](../design-journey.md)
