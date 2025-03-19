# Project 3, Milestone 2: **Consumer** Design Journey

[← Table of Contents](../design-journey.md)


## Milestone 1 Feedback Revisions
> Explain what you revised in response to the Milestone 1 feedback (1-2 sentences)
> If you didn't make any revisions, explain why.

I did not make any revisions sicne we are happy with the result thus far


## Details Page URL
> Design the URL for the consumer's detail page.
> What is the URL for the detail page?

/view-art

> What query string parameters will you include in the URL?

| Query String Parameter Name       | Description       |
| --------------------------------- | ----------------- |
| art_id  | the query string will be referenced by the art id|
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

I affirm that I am submitting my work for the consumer requirements in this milestone.

Consumer Lead: Nicole Lin

[← Table of Contents](../design-journey.md)
