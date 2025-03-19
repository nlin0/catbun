# Project 3, Milestone 2: **Administrator** Design Journey

[← Table of Contents](../design-journey.md)


## Milestone 1 Feedback Revisions
> Explain what you revised in response to the Milestone 1 feedback (1-2 sentences)
> If you didn't make any revisions, explain why.

No revision as according to milestone feedback.


## Edit Page URL
> Design the URL for the administrator's edit page.
> What is the URL for the administrator's edit page?

The URL will be /admin/edit

> What query string parameters will you include in the URL?

| Query String Parameter Name       | Description       |
| --------------------------------- | ----------------- |
| art_id                            |  I will query the art id associated with each artwork. |
|                                   |                   |
|                                   |                   |


## SQL Query Plan
> Plan the SQL query to retrieve a record from one of your query string parameters.

```
SELECT * FROM art WHERE id = :art_id;
```

> Plan the SQL query to retrieve all tag names for a specific record.

```
SELECT tags.name AS 'tags.name'
            FROM art_tags
            INNER JOIN tags ON art_tags.tags_id = tags.id
            WHERE art_tags.art_id = :art_id;
```


## Contributors

I affirm that I am submitting my work for the administrator requirements in this milestone.

Admin Lead: Shihan Gao


[← Table of Contents](../design-journey.md)
