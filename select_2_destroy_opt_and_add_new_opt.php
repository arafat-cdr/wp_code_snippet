tax-listing_category

jQuery('#tax-listing_category').select2('destroy').empty().select2({
data: 
      [   {
            "id": 1,
            "text": "Option 1"
          },
          {
            "id": 2,
            "text": "Option 2",
          },
          {
            "id": 3,
            "text": "Option 3",
          }
      ]

});