SELECT food_item.food_item_id, food_item_name, food_item_cost, food_item_description, food_image_url, food_item_type_name
    FROM food_item
    LEFT JOIN food_item_types ON food_item.food_item_id=food_item_types.food_item_id
    LEFT JOIN food_item_type ON food_item_type.food_item_type_id=food_item_types.food_item_type_id
    LEFT JOIN food_image ON food_image.food_item_id=food_item.food_item_id;