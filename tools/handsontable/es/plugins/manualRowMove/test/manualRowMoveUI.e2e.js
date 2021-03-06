describe('manualRowMove', function () {
  var id = 'testContainer';

  beforeEach(function () {
    this.$container = $('<div id="' + id + '"></div>').appendTo('body');
  });

  afterEach(function () {
    if (this.$container) {
      destroy();
      this.$container.remove();
    }
  });

  describe('UI', function () {
    it('should append UI elements to wtHider after click on row header', function () {
      handsontable({
        data: Handsontable.helper.createSpreadsheetData(30, 30),
        rowHeaders: true,
        manualRowMove: true
      });

      var $headerTH = spec().$container.find('tbody tr:eq(0) th:eq(0)');

      $headerTH.simulate('mousedown');
      $headerTH.simulate('mouseup');
      $headerTH.simulate('mousedown');

      expect(spec().$container.find('.ht__manualRowMove--guideline').length).toBe(1);
      expect(spec().$container.find('.ht__manualRowMove--backlight').length).toBe(1);
    });

    it('should part of UI elements be visible on dragging action', function () {
      handsontable({
        data: Handsontable.helper.createSpreadsheetData(30, 30),
        rowHeaders: true,
        manualRowMove: true
      });

      var $headerTH = spec().$container.find('tbody tr:eq(0) th:eq(0)');

      $headerTH.simulate('mousedown');
      $headerTH.simulate('mouseup');
      $headerTH.simulate('mousedown');

      expect(spec().$container.find('.ht__manualRowMove--guideline:visible').length).toBe(0);
      expect(spec().$container.find('.ht__manualRowMove--backlight:visible').length).toBe(1);
    });

    it('should all of UI elements be visible on dragging action', function () {
      handsontable({
        data: Handsontable.helper.createSpreadsheetData(30, 30),
        rowHeaders: true,
        manualRowMove: true
      });

      var $headers = [spec().$container.find('tbody tr:eq(0) th:eq(0)'), spec().$container.find('tbody tr:eq(1) th:eq(0)'), spec().$container.find('tbody tr:eq(2) th:eq(0)')];

      $headers[0].simulate('mousedown');
      $headers[0].simulate('mouseup');
      $headers[0].simulate('mousedown');
      $headers[1].simulate('mouseover');
      $headers[2].simulate('mouseover');

      expect(spec().$container.find('.ht__manualRowMove--guideline:visible').length).toBe(1);
      expect(spec().$container.find('.ht__manualRowMove--backlight:visible').length).toBe(1);
    });

    describe('backlight', function () {
      it('should set proper left position of element when colWidths is undefined', function () {
        handsontable({
          data: Handsontable.helper.createSpreadsheetData(10, 10),
          rowHeaders: true,
          manualRowMove: true
        });

        var $headerTH = spec().$container.find('tbody tr:eq(0) th:eq(0)');

        $headerTH.simulate('mousedown');
        $headerTH.simulate('mouseup');
        $headerTH.simulate('mousedown');

        expect(spec().$container.find('.ht__manualRowMove--backlight')[0].offsetLeft).toBe(50);
      });

      it('should set proper left position of element when colWidths is defined', function () {
        handsontable({
          data: Handsontable.helper.createSpreadsheetData(10, 10),
          rowHeaders: true,
          manualRowMove: true,
          colWidths: 100
        });

        var $headerTH = spec().$container.find('tbody tr:eq(0) th:eq(0)');

        $headerTH.simulate('mousedown');
        $headerTH.simulate('mouseup');
        $headerTH.simulate('mousedown');

        expect(spec().$container.find('.ht__manualRowMove--backlight')[0].offsetLeft).toBe(50);
      });
    });

    describe('guideline', function () {
      it('should set proper top position of element when target is first row and column headers are disabled', function () {
        handsontable({
          data: Handsontable.helper.createSpreadsheetData(10, 10),
          rowHeaders: true,
          colHeaders: false,
          manualRowMove: true
        });

        var $headers = [spec().$container.find('tbody tr:eq(0) th:eq(0)'), spec().$container.find('tbody tr:eq(1) th:eq(0)')];

        $headers[1].simulate('mousedown');
        $headers[1].simulate('mouseup');
        $headers[1].simulate('mousedown');
        $headers[0].simulate('mouseover');
        $headers[0].simulate('mousemove');

        expect(spec().$container.find('.ht__manualRowMove--guideline')[0].offsetTop).toBe(-1);
      });
    });
  });
});